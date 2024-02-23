<?php
    include "../../model/conexionbd.php";
    $nit  = $_GET['nit'];
    $sentencia = $base_de_datos->query ("SELECT
	    CONCAT(prefijo,' - '  ,numero_documento) factura,
	    fecha,
	    tipo_documento,
	    vendedor,
	    valor,
	    valor_abono,
	    valor_saldo
    from METROPOLIS_EXT.cartera.saldos_clientes sc
    WHERE nit = '$nit'");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $data = array();
    foreach ($clientes as $cliente) {
        $data[] = array(
            "factura"   => $cliente->factura,
            "fecha"   => $cliente->fecha,
            "documento" => $cliente->tipo_documento,
            "vendedor" => $cliente->vendedor,
            "valor" => $cliente->valor,
            "abono" => $cliente->valor_abono,
            "saldo" => $cliente->valor_saldo,
        );
    }
    echo json_encode($data);
?>