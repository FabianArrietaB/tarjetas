<?php
    include "../../model/registros.php";
    $idtiptar = $_POST['idtiptar'];
    $Registros = new Registros();
    echo json_encode($Registros->detallePorcentaje($idtiptar));
?>