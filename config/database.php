<?php
  class Database {
    public static function connect(){

      //crear objeto con la conexion a la base de datos
      //$db = new mysqli('localhost','root','','stjean_DB'); //local
      $db = new mysqli('localhost', 'isbramac_admin', 'KZQEecVEbGLR', 'isbramac_equipementrivs');

      //para que codifique correctamente
      $db->Query("SET NAMES'utf8'");

      //devolver la conexion para las consultas
      return $db;
    }
}
?>
