<?php

class Category
{
  private $id;
  private $name;
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

    public function getName(){
      return $this->name;
    }

    public function setName($name){
      $this->name = $this->db->real_escape_string($name);
    }

    public function getAll(){
      $sql = "SELECT * FROM category ORDER BY name ASC;";

      $category = $this->db->query($sql);

      return $category;
    }//fin function getAll

    public function add(){
      $sql = "INSERT INTO category (id, name) VALUES (NULL, '{$this->getName()}');";

      $category = $this->db->query($sql);

      return $category;
    }//fin function add

    public function modify(){
      $sql = "UPDATE category SET name = '{$this->getName()}' WHERE id = '{$this->getId()}';";

      $category = $this->db->query($sql);

      return $category;
    }//fin function modify

    public function delete(){
      $sql = "DELETE FROM category WHERE id = '{$this->getId()}';";

      $category = $this->db->query($sql);

      return $category;
    }//fin function delete

}//fin class category
 ?>
