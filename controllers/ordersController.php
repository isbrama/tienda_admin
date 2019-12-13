<?php
require_once 'model/category.php';
require_once 'model/products.php';
require_once 'model/orders.php';

class ordersController{

  public function car(){
    Utils::isUser();
    require_once 'views/orders/car.php';
  }

  public function myList(){
    Utils::isUser();
    $users_id = $_SESSION['user']->id;
    $orders = new Orders();
    $orders->setUsersId($users_id);
    $orders = $orders->getById();
    if ($orders) {
      require_once 'views/orders/mylist.php';
    }

    else {
      header("location:".BASE_URL."principal/home");
    }

  }//fin function myList


  public function gestion(){
    Utils::isUser();
    $orders = new Orders();
    $orders = $orders->getAll();
    if ($orders) {
      require_once 'views/orders/gestion.php';
    }
    else {
      header("location:".BASE_URL."principal/home");
    }
  }//fin function gestion()

  public function add(){
    Utils::isUser();
    if(isset($_SESSION['bank'])){

      if (isset($_POST['submit'])) {
        $users_id = isset($_SESSION['user']->id) ? $_SESSION['user']->id : false;
        $company = isset($_POST['company']) ? $_POST['company']: false;
        $cost = isset($_POST['cost']) ? $_POST['cost'] : false;

        if ($users_id && $cost && $company) {
          $order = new Orders();
          $order->setUsersId($users_id);
          $order->setCost($cost);
          $order->setCompany($company);
          $save = $order->add();

          //save line orders
          $result = $order->addLineOrders();

          if($save && $result){
            //modify units per product
            foreach($_SESSION['bank'] as $element){
              $product = new Products();
              $update = $product->updateStock($element['product_id'] , $element['units'] );
            }
            
            Utils::deleteSession('bank');

            header("location:".BASE_URL."orders/mylist");
          }//fin isset $order...
          else {
            header("location:".BASE_URL."products/list");
          }

        }//fin isset users_id && $cost...
        else {
          header("location:".BASE_URL."products/list");
        }
      }//fin isset $_GET['total']...
    }//fin isset$_SESSION['bank']...

    else {
      header("location:".BASE_URL."products/list");
    }

  }//fin function add()

  public function detail(){
    Utils::isUser();
    if(isset($_GET['id'])){
      $id = isset($_GET['id']) ? $_GET['id'] : false ;
      if ($id) {
        $orders = new Orders();
        $orders->setId($id);
        $orders = $orders->detail();
        if ($orders) {
          require_once 'views/orders/detail.php';
        }//fin if orders...
        else {
          header("location:".BASE_URL."principal/home");
        }
      }//fin if id...
      else {
        header("location:".BASE_URL."principal/home");
      }
    }//fin if isset..

    else {
      header("location:".BASE_URL."principal/home");
    }
  }//fin function detail

  public function delete(){
    Utils::isUser();
    if (isset($_GET['id'])) {
      $id = isset($_GET['id']) ? $_GET['id'] : false ;
      if ($id) {
        $orders = new Orders();
        $orders->setId($id);
        $delete= $orders->delete();
        if ($delete) {
          header("location:".BASE_URL."orders/gestion");
        }//if delete
        else {
          header("location:".BASE_URL."principal/home");
        }
    }//fin if id..
    else {
      header("location:".BASE_URL."principal/home");
    }
  }//fin isset($_GET['id'])...
  else {
    header("location:".BASE_URL."principal/home");
  }
}//fin function delete
}
 ?>
