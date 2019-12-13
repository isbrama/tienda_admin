<?php
require_once 'model/products.php';
require_once 'model/category.php';

class productsController{

public function gestion(){
  Utils::isUser();
  $category =  new Category();
  $category = $category->getAll();
  $product =  new Products();
  $product = $product->getAll();
  if ($product) {
    require_once 'views/products/gestion.php';

    //delete error_category if isset
    if (isset($_SESSION['error_products'])) {
      Utils::deleteSession('error_products');
    }
  }//if product...
  else {
    header("location:".BASE_URL."principal/home");
  }

}//fin class gestion

public function add(){
  Utils::isUser();

  if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : false;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;
    $price = isset($_POST['price']) ? $_POST['price'] : false;
    $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
    $size = isset($_POST['size']) ? $_POST['size'] : false;
    $image = isset($_FILES['image']) ? $_FILES['image'] : false;

    if ($name && $category_id && $description && $price && $stock && $image) {

        $product =  new Products();
        $product->setName($name);
        $product->setCategoryId($category_id);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setStock($stock);
        $product->setSize($size);

        //save image to database || server
        $fileImage = $_FILES['image'];
        $product->setImage($fileImage['name']);
        $saveImage = Utils::saveImage($fileImage);
        if (!$saveImage) {
          $_SESSION['error_products'] = "Impossible d'ajouter une image du produit";
        }//fin if !product...

        $product = $product->add();
        if (!$product) {
        $_SESSION['error_products'] = "Impossible d'ajouter un produit";
      }//fin if !product...

    }//fin if items true

    else {
      $_SESSION['error_products'] = "Impossible d'ajouter un produit, Veuillez remplir les champs vides.";
    }

  }//fin if post submit...
  header("location:".BASE_URL."products/gestion");
}//fin function add

public function update(){
  Utils::isUser();
  if (isset($_POST['submit'])) {
    $id= isset($_POST['id']) ? $_POST['id'] : false;
    $name = isset($_POST['name']) ? $_POST['name'] : false;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : false;
    $description= isset($_POST['description']) ? $_POST['description'] : false;
    $price= isset($_POST['price']) ? $_POST['price'] : false;
    $stock= isset($_POST['stock']) ? $_POST['stock'] : false;
    $size= isset($_POST['size']) ? $_POST['size'] : false;
    $image = isset($_FILES['image']) ? $_FILES['image'] : false;

    if ($id && $name && $category_id && $description && $price && $stock && $size && $image) {
      $product= new Products();
      $product->setId($id);
      $product->setName($name);
      $product->setCategoryId($category_id);
      $product->setDescription($description);
      $product->setPrice($price);
      $product->setStock($stock);
      $product->setSize($size);

      //save image to database || server
      $fileImage = $_FILES['image'];
      $product->setImage($fileImage['name']);
      $saveImage = Utils::saveImage($fileImage);
      if (!$saveImage) {
        $_SESSION['error_products'] = "Impossible de modifier une image du produit";
      }//fin if !$saveImage...
      $product= $product->update();
      if (!$product) {
        $_SESSION['error_products'] = "Impossible de modifier un produit";
      }//fin if !product...

    }//fin if items true

    else {
      $_SESSION['error_products'] = "Impossible de modifier un produit, Veuillez remplir les champs vides.";
    }

  }//if submit exist

  header("location:".BASE_URL."products/gestion");
}//fin update function

public function delete(){
  Utils::isUser();
  if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $product =  new Products();
    $product->setId($id);
    $delete = $product->delete();
    if (!$delete) {
      $_SESSION['error_products'] = "Impossible de supprimer, ce produit est lier avec un historique de commande.";
    }//fin if !$delete...
  }//fin if get id...

  header("location:".BASE_URL."products/gestion");
  }//fin function delete

  public function list(){
    Utils::isUser();
    $category = new Category();
    $category = $category->getAll();
    $products = new Products();
    $products = $products->getAll();
    if ($products) {
      require_once 'views/products/list.php';
    }
    else {
      header("location:".BASE_URL."principal/home");
    }
  }//fin function list

}//fin class productsController
 ?>
