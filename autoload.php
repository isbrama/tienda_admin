<?php

//cargar todos los archivos de las clases que yo tenga
 function controllers_autoload($class){
   //entra en la carpeta controllers y hace un include de los controladores
  require_once 'controllers/'.$class.'.php';
}
spl_autoload_register('controllers_autoload');

 ?>
