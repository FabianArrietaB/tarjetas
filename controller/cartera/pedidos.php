<?php
    session_start();
    include "../../model/cartera.php";
    $Cartera = new Cartera();
    $pedido = $_GET['pedido'];
    echo json_encode($Cartera->pedido($pedido));
?>