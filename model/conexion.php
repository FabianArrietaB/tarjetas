<?php
date_default_timezone_set('America/Bogota');
class Conexion{

   protected $dbh;

   public function conectar(){
      $servidor = "localhost";
      $usuario = "root";
      $password = "";
      $db = "tarjetas";
      $conexion = mysqli_connect($servidor, $usuario, $password, $db);
      return $conexion;
   }
}
?>