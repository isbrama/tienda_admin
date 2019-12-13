<?php
require_once 'model/category.php';

class categoryController
{

  public function gestion(){
    Utils::isUser();

    $category =  new Category();
    $category = $category->getAll();
    if ($category) {
      require_once 'views/category/gestion.php';

      //delete error_category if isset
      if (isset($_SESSION['error_category'])) {
        Utils::deleteSession('error_category');
      }

    }
    else {
      header("location:".BASE_URL."principal/home");
    }
  }

  public function add(){
    Utils::isUser();
    if (isset($_POST['submit'])) {
      $name = isset($_POST['name']) ? $_POST['name'] : false;
      $category = new Category();
      $category->setName($name);
      $category= $category->add();
      if (!$category) {
        $_SESSION['error_category'] = "Impossible d'ajouter une categorie";
      }
    }

    else {
      $_SESSION['error_category'] = "Impossible d'ajouter une categorie";
    }

    header("location:".BASE_URL."category/gestion");
  }//fin function add

  public function modify(){
    Utils::isUser();
    if (isset($_POST['id'])) {
      $id= isset($_POST['id']) ? $_POST['id'] : false;
      $name = isset($_POST['name']) ? $_POST['name'] : false;
      $category = new Category();
      $category->setId($id);
      $category->setName($name);
      $category= $category->modify();
      if (!$category) {
        $_SESSION['error_category'] = "Impossible de modifier cette categorie";
      }
    }
    else {
      $_SESSION['error_category'] = "Impossible de modifier cette categorie";
    }

    header("location:".BASE_URL."category/gestion");

  }

  public function delete(){
    Utils::isUser();

    if (isset($_GET['id'])) {
      $id = isset($_GET['id']) ? $_GET['id'] : false;
      $category =  new Category();
      $category->setId($id);
      $category = $category->delete();
      if (!$category) {
        $_SESSION['error_category'] = "Impossible de supprimer, un produit est lier avec cette catégorie.";
      }
    }

    else {
      $_SESSION['error_category'] = "Impossible de supprimer cette catégorie";
    }
    header("location:".BASE_URL."category/gestion");
  }//fin function delete

}//fin class categoryController

 ?>
