<?php
    session_start();
    include "../../model/registros.php";
    $Registros   = new Registros();
    $idconciliacion  = $_POST['idconciliacion'];
    $estado     = $_POST['estado'];
    echo $Registros->eliminarconciliacion($idconciliacion, $estado);
?>