<?php
date_default_timezone_set('America/Bogota');
class Conexion{

   protected $dbh;

   public function conectar(){
      $servidor = "localhost";
      $usuario = "";
      $password = "";
      $db = "tarjetas";
      $conexion = mysqli_connect($servidor, $usuario, $password, $db);
      return $conexion;
   }

   public function conectarFomplus(){
      $servidor = "SERVIDOR";
      $usuario  = "";
      $password = "";
      $db       = "";
      try {
         $conexion = new PDO("sqlsrv:server=$servidor;database=$db", $usuario, $password);
         $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (Exception $e) {
         echo "Ocurrió un error con la base de datos: " . $e->getMessage();
      }
      return  $conexion;
   }
}
?>
