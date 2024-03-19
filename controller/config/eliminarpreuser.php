<?php
    $id = $_POST['id'];
    include "../../model/config.php";
    $Prefijo = new Config();
    echo $Prefijo->eliminarpreuser($id);
?>