<?php
    include "../../model/registros.php";
    $franquicia = $_POST['franquicia'];
    $fecha = $_POST['fecha'];
    $sede = $_POST['sede'];
    $Registros = new Registros();
    echo $Registros->ConsultaDiferencia($franquicia, $fecha, $sede);
?>