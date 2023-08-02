<?php
   session_start();
   $datos = array(
    'idoperador'     => $_SESSION['usuario']['id'],
    "ticket"         => $_POST['ticket'],
    "idtiptar"       => $_POST['idtiptar'],
    "tiptar"         => $_POST['tiptar'],
    "valor"          => $_POST['valor'],
    "iva"            => $_POST['iva'],
    "retfue"         => $_POST['retfue'],
    "retiva"         => $_POST['retiva'],
    "retica"         => $_POST['retica'],
    "comisi"         => $_POST['comisi'],
    "banco"          => $_POST['banco'],
    "diferencia"     => $_POST['diferencia'],
   );

   include "../../model/registros.php";
   $Registros = new Registros();
   echo $Registros->addregistro($datos);
?>