<?php
    include "../../model/registros.php";
    $idconciliacion = $_POST['idconciliacion'];
    $Registros = new Registros();
    echo json_encode($Registros->detalleconciliacion($idconciliacion));
?>