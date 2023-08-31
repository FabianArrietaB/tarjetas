<?php
    session_start();
    include "../../model/registros.php";
    $Registros   = new Registros();
    $idregistro  = $_POST['idregistro'];
    $estado     = $_POST['estado'];
    echo $Registros->eliminarregistro($idregistro, $estado);
?>