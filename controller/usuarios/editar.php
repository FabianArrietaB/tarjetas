<?php
    session_start();
    $datos = Array(
        'idoperador' => $_SESSION['usuario']['id'],
        "idusuario"  => $_POST['idusuario'],
        "idrol"      => $_POST['idrolu'],
        "idarea"     => $_POST['idareau'],
        "idsede"     => $_POST['idsedeu'],
        "usuario"    => $_POST['usuariou'],
        "password"   => md5($_POST['passwordu']),
    );
    include "../../models/usuarios.php";
    $Usuarios = new Usuarios();
    echo $Usuarios->editarusuario($datos);
?>