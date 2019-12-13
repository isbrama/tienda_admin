<?php
class Users{

  private $id;
  private $name;
  private $email;
  private $password;
  private $rol;
  private $image;
  private $db;

    function __construct(){
      $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
       $this->name = $this->db->real_escape_string($name);

    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }

    public function setPassword($password)
    {
        $this->password = $password;

    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $this->db->real_escape_string($rol);
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getOne(){

      $result = false;

      $sql = "SELECT * FROM users WHERE email = '{$this->getEmail()}';";

      $users = $this->db->query($sql);

      if ($users && $users->num_rows==1) {
          $user = $users->fetch_object();
          //check password
          $verify = password_verify($this->password, $user->password);

          if ($verify) {
            $result = $user;
          }
      }
      return $result;
    }

    public function getOneById(){
      $sql = "SELECT * FROM users WHERE id = '{$this->getId()}';";

      $user = $this->db->query($sql);

      return $user->fetch_object();
    }


    public function getAll(){
      $sql = "SELECT * FROM users ORDER BY id DESC;";

      return $this->db->query($sql);
    }

    public function add(){
      $sql = "INSERT INTO users (id, name, email, password, rol, image) VALUES (NULL, '{$this->getName()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getRol()}', NULL);";

      return $this->db->query($sql);
    }

    public function modify(){
      $sql = "UPDATE users SET name = '{$this->getName()}', email = '{$this->getEmail()}', password= '{$this->getPassword()}', rol = '{$this->getRol()}' WHERE id = '{$this->getId()}';";

      return $this->db->query($sql);
    }

    public function delete(){
      $sql = "DELETE FROM users WHERE id = '{$this->getId()}';";

      return $this->db->query($sql);
    }

}//fin class Users
 ?>
