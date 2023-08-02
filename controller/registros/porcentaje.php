<?php
    include "../../model/registros.php";
    $idtiptar = $_POST['idtiptaru'];
    $Registros = new Registros();
    echo json_encode($Registros->detallePorcentaje($idtiptar));
?>