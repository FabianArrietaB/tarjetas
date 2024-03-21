<?php
    session_start();
    include "../../model/conexionbd.php";
    $sentencia = $base_de_datos->query ("SELECT
        id
        ,nit
        ,prefijo
        ,numero_documento
        ,tipo_documento
        ,nit_vendedor
        ,vendedor
        ,plazo
        ,fecha
        ,fecha_vencimiento
        ,dias_vencimiento
        ,valor
        ,valor_abono
        ,valor_saldo
        ,VEN_NOMBRE
        ,CLI_CEDULA
        ,CLI_NOMBRE
        ,CLI_VENDED
    FROM MAECXC
    INNER JOIN MAEVEN ON VEN_CEDULA = CLI_VENDED
    INNER JOIN [METROPOLIS_EXT].[cartera].[saldos_clientes] ON [nit] = [CLI_CEDULA]");
    $empleados = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>DOCUMENTO</th>
                <th>CLIENTE</th>
                <th>VENDEDOR FACTURA</th>
                <th>VENDEDOR CARTERA</th>
                <th>VALOR ABONO</th>
                <th>VALOR SALDO</th>
            </tr>
        </thead>
        <tbody id="tblrecaudos">
            <?php
            foreach($empleados as $empleados) {
            ?>
            <tr>
                <td><?php echo $empleados->CLI_CEDULA ?></td>
                <td><?php echo $empleados->CLI_NOMBRE ?></td>
                <td><?php echo $empleados->vendedor ?></td>
                <td><?php echo $empleados->VEN_NOMBRE ?></td>
                <td><?php echo $empleados->valor ?></td>
                <td><?php echo $empleados->valor_saldo ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>