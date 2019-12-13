<?php

class Products
{
  private $id;
  private $category_id;
  private $name;
  private $description;
  private $price;
  private $stock;
  private $date;
  private $size;
  private $image;
  private $db;

    function __construct(){
      $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getCategoryId(){
        return $this->category_id;
    }

    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $this->db->real_escape_string($name);
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $this->db->real_escape_string($description);
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $this->db->real_escape_string($price);
    }

    public function getStock(){
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($size){
        $this->size = $this->db->real_escape_string($size);
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $this->db->real_escape_string($image);
    }

    public function getOne(){
      $sql = "SELECT * FROM products WHERE id = '{$this->getId()}'";

      $product = $this->db->query($sql);

      $product = $product->fetch_object();

      return $product;
    }//fin funtion getOne

    public function getAll(){
      $sql = "SELECT products.*, category.name AS 'category'";
      $sql .="FROM products ";
      $sql .="INNER JOIN  category ON products.category_id = category.id ";
      $sql .="ORDER BY id DESC;";

      $products = $this->db->query($sql);

      return $products;
    }//fin function getAll

    public function productsByCategory($category){
      $sql = "SELECT * FROM products WHERE category_id = $category;";

      return $this->db->query($sql);
    }//fin function productsByCategory

    public function add(){
      $sql = "INSERT INTO products (id, category_id, name, description, price, stock, size, date, image) ";
      $sql.= "VALUES (NULL, '{$this->getCategoryId()}', ";
      $sql.= "'{$this->getName()}', ";
      $sql.= "'{$this->getDescription()}', ";
      $sql.= "'{$this->getPrice()}', ";
      $sql.= "'{$this->getStock()}', ";
      $sql.= "'{$this->getSize()}', ";
      $sql.= "CURDATE(), '{$this->getImage()}');";

      $products = $this->db->query($sql);
  
      return $products;
    }//fin function add

    public function delete(){
      $sql = "DELETE FROM products WHERE id = '{$this->getId()}';";

      $products = $this->db->query($sql);

      return $products;
    }//fin function delete

    public function update(){
      $sql = "UPDATE products SET category_id = '{$this->getCategoryId()}', ";
      $sql .= "name = '{$this->getName()}', ";
      $sql .= "description = '{$this->getDescription()}', ";
      $sql .= "price = '{$this->getPrice()}', ";
      $sql .= "stock = '{$this->getStock()}', ";
      $sql .= "date = CURDATE(), ";
      $sql.=  "size = '{$this->getSize()}', ";
      $sql .= "image = '{$this->getImage()}' ";
      $sql .= "WHERE id = '{$this->getId()}';";

      $products = $this->db->query($sql);

      return $products;
    }//fin function update

    public function updateStock($id , $stock){
      $sql = "UPDATE products SET stock = stock -'$stock' WHERE id = $id;";

      return $this->db->query($sql);
    }//fin function updateStock

}//fin class products
 ?>
