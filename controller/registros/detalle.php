<?php
    include "../../modelo/inicio.php";
    $idtiptar = $_POST['idtiptar'];
    $Registros = new Registros();
    echo json_encode($Registros->detallePorcentaje($idtiptar));
?>