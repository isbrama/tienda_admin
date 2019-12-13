<?php
require_once 'model/users.php';
class usersController
{

public function login(){
    Utils::deleteSession('error_login');
    if (isset($_POST['submit'])) {
      $email = isset($_POST['email']) ? $_POST['email'] : false;
      $password = isset($_POST['password']) ? $_POST['password'] : false;

      if ($password && $email) {
        $user = new Users();
        $user->setEmail($email);
        $user->setPassword($password);
        $user = $user->getOne();

        if ($user) {
          //check if user password and this $password true
          //si todo esta bien afichar la pagina admin
            $_SESSION['user'] = $user;

            if ($user->rol == 'admin') {

              $_SESSION['admin'] = $user;
            }

            header("location:".BASE_URL."users/welcome");

        } // fin if user true
        else {
          $_SESSION['error_login'] = " Usager incorrect";
          header("location:".BASE_URL."principal/index");
        }
      } // fin if password and email true
      else {
        $_SESSION['error_login'] = "Verifier l'usager et password, reessayer encore.";
        header("location:".BASE_URL."principal/index");
      }
    }// if POST true
  }//fin function login

  public function welcome(){
    utils::isUser();
    require_once 'views/users/welcome.php';
  }

  public function gestion(){
    utils::isUser();
    $user =  new Users();
    $user = $user->getAll();
    if ($user) {
      require_once 'views/users/gestion.php';
    }

    else {
      header("location:".BASE_URL."principal/home");
    }

  }

  public function add(){
    utils::isUser();
    if (isset($_POST['submit'])) {
      $name = isset($_POST['name']) ? $_POST['name'] : false;
      $email = isset($_POST['email']) ? $_POST['email'] : false;
      $password = isset($_POST['password']) ? $_POST['password'] : false;
      $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
      
      if ($name && $email && $password && $rol  ) {
        $user =  new Users();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRol($rol);
        $user=$user->add();
        if (!$user) {
          $_SESSION['error_users'] = "Impossible d'ajouter un usager";
        }//fin if not user
      }//if items exist
    }//fin is post submit

    header("location:".BASE_URL."users/gestion");

  }//fin function add

  public function modify(){
    utils::isUser();
    if (isset($_POST['submit'])) {

      $id= isset($_POST['id']) ? $_POST['id'] : false;
      $name = isset($_POST['name']) ? $_POST['name'] : false;
      $email = isset($_POST['email']) ? $_POST['email'] : false;
      $password= isset($_POST['password']) ? $_POST['password'] : false;
      $rol= isset($_POST['rol']) ? $_POST['rol'] : false;

      if ($id && $name && $email && $password && $rol  ) {
        $user= new Users();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRol($rol);
        $user= $user->modify();
        if (!$user) {
          $_SESSION['error_users'] = "Impossible de modifier un usager";
        }//fin if not user
      }//fin if items exist
      if (!$user) {
        $_SESSION['error_users'] = "Impossible de modifier un usager";
      }//fin if not user

    }//fin if post submit...

    header("location:".BASE_URL."users/gestion");
  }//fin function update

  public function delete(){
    utils::isUser();
    if (isset($_GET['id']) ) {
      $id = isset($_GET['id']) ? $_GET['id'] : false;
      $user =  new Users();
      $user->setId($id);
      $delete = $user->delete();
      if (!$delete) {
        $_SESSION['error_users'] = "Impossible de supprimer un usager";
      }
    }
    header("location:".BASE_URL."users/gestion");
  }//fin funciton delete

}//fin class usersController

 ?>
