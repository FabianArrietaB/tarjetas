<?php
    include "../../model/conexionbd.php";
    $nit  = $_GET['nit'];
    $sentencia = $base_de_datos->query ("SELECT
        CONCAT(sc.prefijo,' - '  ,sc.numero_documento) factura,
        sc.fecha fecha,
        sc.tipo_documento docume,
        sc.vendedor  vendedor,
        sc.valor valor,
        sc.valor_abono abono,
        sc.valor_saldo saldo,
        c.CLI_NOMBRE  cliente,
        c.CLI_TELEFO telefo,
        c.CLI_DIRECC direcc,
        c.CLI_EMAIL	 correo
    FROM METROPOLIS_EXT.cartera.saldos_clientes sc
    INNER JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
    WHERE nit = '$nit'");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $data = array();
    foreach ($clientes as $cliente) {
        $data[] = array(
            "factura"   => $cliente->factura,
            "fecha"   => $cliente->fecha,
            "documento" => $cliente->docume,
            "vendedor" => $cliente->vendedor,
            "valor" => $cliente->valor,
            "abono" => $cliente->abono,
            "saldo" => $cliente->saldo,
            "cliente" => $cliente->cliente,
            "telefono" => $cliente->telefo,
            "direccion"=>$cliente->direcc,
            "correo" => $cliente->correo
        );
    }
    echo json_encode($data);
?>