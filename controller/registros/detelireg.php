<?php
    include "../../model/registros.php";
    $Registros = new Registros();
    $idregistro = $_POST['idregistro'];
    echo json_encode($Registros->detalleregistro($idregistro));
?>