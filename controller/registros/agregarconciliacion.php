<?php
   session_start();
   $datos = array(
    'idoperador'     => $_SESSION['usuario']['id'],
    "franquicia"     => $_POST['franquicia'],
    "sede"           => $_POST['sede'],
    "fecha"          => $_POST['fecha'],
    "newdif"         => $_POST['newdif'],
    "bandif"         => $_POST['bandif'],
    "newrte"         => $_POST['newrte'],
    "banrte"         => $_POST['banrte'],
    "newiva"         => $_POST['newiva'],
    "baniva"         => $_POST['baniva'],
    "newica"         => $_POST['newica'],
    "banica"         => $_POST['banica'],
    "newcom"         => $_POST['newcom'],
    "bancom"         => $_POST['bancom'],
   );

   include "../../model/registros.php";
   $Registros = new Registros();
   echo $Registros->adddiferencia($datos);
?>