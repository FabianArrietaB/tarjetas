<?php
    include "../../model/registros.php";
    $mes = $_GET['mes'];
    $Registros = new Registros();
    echo json_encode($Registros->detallefecha($mes));
?>