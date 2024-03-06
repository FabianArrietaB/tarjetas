<?php
    session_start();
    $datos = array(
        'idoperador' => $_SESSION['usuario']['tarid'],
        "idsede"     => $_POST['preidsede'],
        "nombre"     => $_POST['prefijo'],
    );

    include "../../model/config.php";
    $Prefijo = new Config();
    echo $Prefijo->addprefijo($datos);
?>