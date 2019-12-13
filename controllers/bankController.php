<?php
require_once 'model/products.php';

class bankController{

  public function car(){
    Utils::isUser();
    if (isset($_SESSION['bank']) && count($_SESSION['bank'])>=1) {
      $bank = $_SESSION['bank'];
    }

    else {
      $bank= array();
    }
    require_once 'views/bank/car.php';
  }

  public function add(){
    Utils::isUser();
    if (isset($_GET['id'])) {
      $product_id = $_GET['id'];
    }

    else {
      header("location:".BASE_URL."products/list");
    }

    if (isset($_SESSION['bank'])) {
      $counter=0;

      foreach ($_SESSION['bank'] as $key => $value) {
        if ($value['product_id']==$product_id) {
          $_SESSION['bank'][$key]['units']++;
          $counter++;
        }
      }
    } //fin foreach

    if (!isset($counter) || $counter == 0) {
      //conseguir producto
      $product = new Products();
      $product->setId($product_id);
      $product= $product->getOne();

      //bank array
      if (is_object($product)) {
        //add a product to an array (the array is a session array)
        $_SESSION['bank'][] = array(
          "product_id" => $product->id ,
          "total_price_units" => $product->price ,
          "units" => 1 ,
          "product" => $product
        );

      }//fin if condition (is_object($product)...)
    }//fin if condition (!isset($counter)...)
    header("location:".BASE_URL."bank/car");
  }//fin function add


  public function delete(){
    Utils::isUser();
    if (isset($_GET['index'])) {
      $index = $_GET['index'];
      unset($_SESSION['bank'][$index]);
    }
    header("location:".BASE_URL."bank/car");
  }

  public function deleteAll(){
    Utils::isUser();
    Utils::deleteSession('bank');
    header("location:".BASE_URL."bank/car");
  }//fin function deleteAll()

  public function up(){
    Utils::isUser();
    if (isset($_GET['index'])) {
      $index = $_GET['index'];
      $_SESSION['bank'][$index]['units']++;
    }
    header("location:".BASE_URL."bank/car");
  }//fin function up

  public function down(){
    Utils::isUser();
    if (isset($_GET['index'])) {
      $index = $_GET['index'];
      $_SESSION['bank'][$index]['units']--;

      if ($_SESSION['bank'][$index]['units']==0) {
            unset($_SESSION['bank'][$index]);
      }
    }
    header("location:".BASE_URL."bank/car");
  }//fin function down

}//fin class bankController

?>
