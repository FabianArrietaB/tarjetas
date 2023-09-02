<?php
   session_start();
   $datos = array(
    'idoperador'      => $_SESSION['usuario']['tarid'],
    "idconciliacion"  => $_POST['idconciliacion'],
    "updnewdif"       => $_POST['updnewdif'],
    "updbandif"       => $_POST['updbandif'],
    "updnewrte"       => $_POST['updnewrte'],
    "updbanrte"       => $_POST['updbanrte'],
    "updnewiva"       => $_POST['updnewiva'],
    "updbaniva"       => $_POST['updbaniva'],
    "updnewica"       => $_POST['updnewica'],
    "updbanica"       => $_POST['updbanica'],
    "updnewcom"       => $_POST['updnewcom'],
    "updbancom"       => $_POST['updbancom'],
   );

   include "../../model/registros.php";
   $Registros = new Registros();
   echo $Registros->editarconcilacion($datos);
?>