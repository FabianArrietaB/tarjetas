<?php
    $id = $_POST['id'];
    include "../../model/config.php";
    $Datafono = new Config();
    echo $Datafono->eliminardatuser($id);
?>