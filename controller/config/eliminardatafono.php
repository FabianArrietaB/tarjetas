<?php
    $iddatafono = $_POST['iddatafono'];
    include "../../model/config.php";
    $Datafono = new Config();
    echo $Datafono->eliminardatafono($iddatafono);
?>