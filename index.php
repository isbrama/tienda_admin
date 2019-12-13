<?php
session_start();
require_once 'autoload.php';
require_once 'config/database.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){
  $error= new errorController();
  $error->index();
}

if (isset($_GET['controller']) && class_exists($_GET['controller'] )) {

  $nombreControlador = $_GET['controller'];

  $controlador = new $nombreControlador();

  if (isset($_GET['action']) && method_exists($controlador, $_GET['action'] )) {

    $action=$_GET['action'];

    $controlador->$action();

  }

  else {
      show_error();
  }
}

elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {

  $nombreControlador = DEFAULT_CONTROLLER;

  $controlador = new $nombreControlador();

  $action=ACTION_DEFAULT;

  $controlador->$action();
}

else {
  show_error();
}
require_once 'views/layout/footer.php';
?>
