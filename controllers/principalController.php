<?php

class principalController
{

public function index(){
  require_once 'views/principal/index.php';
}

public function home(){
  Utils::isUser();
  require_once 'views/principal/home.php';
}

public function disconnect(){
  Utils::deleteSession('user');
  Utils::deleteSession('error_login');
  Utils::deleteSession('bank');
  header("location:".BASE_URL."principal/index");
}

}

 ?>
