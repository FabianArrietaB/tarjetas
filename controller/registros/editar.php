<?php
   session_start();
   $datos = array(
      'idoperador'     => $_SESSION['usuario']['tarid'],
      "idregistro"     => $_POST['idregistro'],
      "prefijo"        => $_POST['prefijou'],
      "ticket"         => $_POST['ticketu'],
      "idtiptar"       => $_POST['idtiptaru'],
      "tiptar"         => $_POST['tiptaru'],
      "valor"          => $_POST['valoru'],
      "iva"            => $_POST['ivau'],
      "retfue"         => $_POST['retfueu'],
      "retiva"         => $_POST['retivau'],
      "retica"         => $_POST['reticau'],
      "comisi"         => $_POST['comisiu'],
      "banco"          => $_POST['bancou'],
      "diferencia"     => $_POST['diferenciau'],
      "fecha"          => $_POST['fechau'],
   );

   include "../../model/registros.php";
   $Registros = new Registros();
   echo $Registros->editarregistro($datos);
?>