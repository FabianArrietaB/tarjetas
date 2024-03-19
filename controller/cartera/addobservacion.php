<?php
    session_start();
    $datos = array(
        'idoperador'     => $_SESSION['usuario']['tarid'],
        "nit"       => $_POST['nit'],
        "nombre"         => $_POST['nombre'],
        "detalle"         => $_POST['detalle'],
    );

    include "../../model/cartera.php";
    $Cartera = new Cartera();
    echo $Cartera->addobservacion($datos);
?>