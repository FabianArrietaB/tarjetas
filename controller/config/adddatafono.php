<?php
    session_start();
    $datos = array(
        'idoperador' => $_SESSION['usuario']['tarid'],
        "idsede"     => $_POST['idsede'],
        "datafono"   => $_POST['datafono'],
        "serial"     => $_POST['serial'],
    );

    include "../../model/config.php";
    $Datafono = new Config();
    echo $Datafono->adddatafono($datos);
?>