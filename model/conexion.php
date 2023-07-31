<?php
class Conexion{

   protected $dbh;

   public function conectar(){
      $servidor = "localhost";
      $usuario = "root";
      $password = "";
      $db = "sistemas";
      $conexion = mysqli_connect($servidor, $usuario, $password, $db);
      return $conexion;
   }

   public function conectarbd(){
      $servidor = "localhost";
      $usuario = "root";
      $password = "";
      $db = "tarjetas";
      $conexion = mysqli_connect($servidor, $usuario, $password, $db);
      return $conexion;
   }
}
?>