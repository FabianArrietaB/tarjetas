<?php
    include "../../models/usuarios.php";
    $Usuarios = new Usuarios();
    $idusuario = $_POST['idusuario'];
    echo json_encode($Usuarios->detallepass($idusuario));
?>