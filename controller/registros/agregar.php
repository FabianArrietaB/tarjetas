<?php
   session_start();
   $datos = array(
    'idoperador'     => $_SESSION['usuario']['id'],
    "ticket"         => $_POST['ticket'],
    "idtiptar"       => $_POST['idtiptar'],
    "valor"          => $_POST['valor'],
    "iva"            => $_POST['iva'],
    "comisi"         => $_POST['comisi'],
    "diferencia"     => $_POST['diferencia'],
   );

   include "../../models/registros.php";
   $Registros = new Registros();
   echo $Registros->addregistro($datos);
?>