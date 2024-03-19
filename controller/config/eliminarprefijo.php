<?php
    $idprefijo = $_POST['idprefijo'];
    include "../../model/config.php";
    $Prefijo = new Config();
    echo $Prefijo->eliminarprefijo($idprefijo);
?>