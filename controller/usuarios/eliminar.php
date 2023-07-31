<?php
    $idusuario = $_POST['idusuario'];
    include "../../models/usuarios.php";
    $Usuarios = new Usuarios();
    echo $Usuarios->eliminarusuario($idusuario);
?>