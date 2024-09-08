<?php
    session_start();
    include "../../model/cartera.php";
    $Cartera = new Cartera();
    $docume = $_GET['docume'];
    echo json_encode($Cartera->cliente_vendedor($docume));
?>