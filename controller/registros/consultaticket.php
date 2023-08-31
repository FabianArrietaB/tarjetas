<?php
    include "../../model/registros.php";
    $pretik = $_POST['pretik'];
    $ticket = $_POST['ticket'];
    $Registros = new Registros();
    echo $Registros->ConsultaFactura($pretik, $ticket);
?>