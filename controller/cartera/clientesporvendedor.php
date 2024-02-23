<?php
    include "../../model/conexionbd.php";
    $docume  = "";
    if(isset($_GET['docume'])){
        $docume=$_GET["docume"];
    }
    $sentencia = $base_de_datos->query ("SELECT
	c.CLI_NOMBRE cliente,
	c.CLI_CEDULA nit,
    sc.vendedor vendedor,
        SUM(CASE WHEN dias_vencimiento < 1 THEN valor_saldo ELSE 0 END) por_vencer,
        SUM(CASE WHEN dias_vencimiento BETWEEN 1 AND 30 THEN valor_saldo ELSE 0 END) dias_1_a_30,
        SUM(CASE WHEN dias_vencimiento BETWEEN 31 AND 60 THEN valor_saldo ELSE 0 END) dias_31_a_60,
        SUM(CASE WHEN dias_vencimiento BETWEEN 61 AND 90 THEN valor_saldo ELSE 0 END) dias_61_a_90,
        SUM(CASE WHEN dias_vencimiento > 90 THEN valor_saldo ELSE 0 END) dias_mayor_90,
        SUM(sc.valor_saldo) saldo
    from METROPOLIS_EXT.cartera.saldos_clientes sc
    LEFT JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
    LEFT JOIN METROCERAMICA.dbo.MAEVEN v ON v.VEN_CEDULA = c.CLI_VENDED
    WHERE c.CLI_VENDED  = '$docume'
    GROUP BY c.CLI_NOMBRE, c.CLI_CEDULA, sc.vendedor");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $data = array();
    foreach ($clientes as $cliente) {
        $data[] = array(
            "cliente" => $cliente->cliente,
            "nit" => $cliente->nit,
            "vendedor" => $cliente->vendedor,
            "por_vencer" => $cliente->por_vencer,
            "dias_1_a_30" => $cliente->dias_1_a_30,
            "dias_31_a_60" => $cliente->dias_31_a_60,
            "dias_61_a_90" => $cliente->dias_61_a_90,
            "dias_mayor_90" => $cliente->dias_mayor_90,
            "saldo" => $cliente->saldo,
        );
    }
    echo json_encode($data);
?>