<?php
    include "../../model/cartera.php";
    $cartera = new Cartera();
    echo json_encode($cartera->clientes());
?>