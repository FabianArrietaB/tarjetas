<?php
    include "../../model/registros.php";
    $iddatafo = $_POST['iddatafo'];
    $pretik = $_POST['pretik'];
    $ticket = $_POST['ticket'];
    $Registros = new Registros();
    echo $Registros->ConsultaFactura($pretik, $iddatafo, $ticket);
?>