<?php
    include "../../model/conexionbd.php";
    $sentencia = $base_de_datos->query ("SELECT
        v.VEN_CEDULA docume,
        v.VEN_NOMBRE vendedor,
        v.VEN_ACTIVO activo,
        SUM(sc.valor_saldo) saldo
    from METROPOLIS_EXT.cartera.saldos_clientes sc
    LEFT JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
    LEFT JOIN METROCERAMICA.dbo.MAEVEN v ON v.VEN_CEDULA = c.CLI_VENDED
    GROUP BY v.VEN_CEDULA, v.VEN_NOMBRE, v.VEN_ACTIVO
    ORDER BY v.VEN_ACTIVO");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
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