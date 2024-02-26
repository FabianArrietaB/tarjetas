<?php
    include "../../model/conexion.php";
    $nit = $_GET['nit'];
    $con = new Conexion();
    $conexion = $con->conectar();
    $sql ="SELECT DISTINCT
    r.reg_fecope as fecha
    FROM registros as r
    ORDER BY fecha DESC";
    $respuesta = mysqli_query($conexion, $sql);
    $data = array();
    foreach ($clientes as $cliente) {
        $data[] = array(
            "docume"   => $cliente->docume,
            "vendedor" => $cliente->vendedor,
            "activo" => $cliente->activo,
            "total" => $cliente->saldo,
        );
    }
    echo json_encode($data);
?>