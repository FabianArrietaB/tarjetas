<?php
    include "../../model/conexionbd.php";
    $sentencia = $base_de_datos->query ("SELECT * FROM MAECXC");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $data = array();
    foreach ($clientes as $cliente) {
        $data[] = array(
            'id' => $cliente->CLI_CEDULA,
            "text" => $cliente->CLI_NOMBRE,
        );
    }
    echo json_encode($data);
?>