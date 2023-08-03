<?php
    include "../../model/registros.php";
    $dategen = $_GET['dategen'];
    $sede = $_GET['sede'];
    $Registros = new Registros();
    echo json_encode($Registros->detallegeneral($dategen, $sede));
?>