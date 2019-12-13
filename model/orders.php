<?php
class Orders{
  private $id;
  private $users_id;
  private $cost;
  private $date;
  private $hour;
  private $company;
  private $status;
  private $db;

  function __construct(){
        $this->db= Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsersId(){
        return $this->users_id;
    }

    public function setUsersId($users_id){
        $this->users_id = $users_id;
    }

    public function getCost(){
        return $this->cost;
    }

    public function setCost($cost){
        $this->cost = $this->db->real_escape_string($cost);
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getHour(){
        return $this->hour;
    }

    public function setHour($hour){
        $this->hour = $hour;
    }

    public function getCompany(){
        return $this->company;
    }

    public function setCompany($company){
        $this->company = $this->db->real_escape_string($company);
    }

    public function getAll(){
      $sql  = "SELECT orders.*, users.name AS 'user' ";
    	$sql .=	"FROM orders ";
    	$sql .=	"INNER JOIN users ON users.id = orders.users_id ";
    	$sql .=	"ORDER BY id DESC";

      $order = $this->db->query($sql);

      return $order;
    }//fin function getAll

    public function getById(){
      $sql = "SELECT * FROM orders WHERE users_id = '{$this->getUsersId()}' ORDER BY id DESC";

      $order = $this->db->query($sql);

      return $order;
    }//fin function getAll

    public function add(){
      $sql = "INSERT INTO orders (id, users_id, cost, status, date, hour, company)";

      $sql .= "VALUES (NULL, '{$this->getUsersId()}', '{$this->getCost()}', 'confirmé', CURDATE(), CURTIME(), '{$this->getCompany()}');";

      $order = $this->db->query($sql);

      return $order;
    }//fin function add

    public function addLineOrders(){
      $sql= "SELECT LAST_INSERT_ID() AS 'order';";

      $query = $this->db->query($sql);

      $orderId = $query->fetch_object()->order;

      foreach ($_SESSION['bank'] as $element)  {

        $product = $element['product'];

        $insert = "INSERT INTO line_orders VALUES (null, $orderId, {$product->id}, {$element['units']});";

        $save = $this->db->query($insert);

      }

      $result = false;

      if ($save) {
        $result = true;
      }
      return $result;
    }//fin function addLineOrders

    public function detail(){
      $sql = "SELECT line_orders.* , orders.cost, products.name, products.image, products.price*line_orders.units as 'totalPrice'";
		  $sql.= "FROM orders ";
		  $sql.= "JOIN line_orders ON line_orders.orders_id = orders.id ";
		  $sql.= "JOIN products ON line_orders.products_id = products.id ";
		  $sql.= "WHERE line_orders.orders_id = '{$this->getId()}' " ;
		  $sql.= "ORDER BY line_orders.orders_id DESC ;";

      $order = $this->db->query($sql);

      return $order;
    }//fin function detail

    public function delete(){
      $sql="DELETE FROM line_orders WHERE orders_id = '{$this->getId()}';";

      $order = $this->db->query($sql);

      if ($order) {

        $sql="DELETE FROM orders WHERE id = '{$this->getId()}';";

        $order = $this->db->query($sql);

      }

      return $order;
    }//fin function delete

}//fin class Orders

 ?>
