<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectarbd();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        r.id_registro     as idregistro,
        r.id_operador     as idoperador,
        r.reg_numticket   as ticket,
        r.reg_tipcuenta   as idtipcuenta,
        r.reg_tiptar      as tiptar,
        r.reg_valor       as valor,
        r.reg_iva         as iva,
        r.reg_rtefte      as retfte,
        r.reg_rteiva      as rteiva,
        r.reg_rteica      as rteica,
        r.reg_comision    as comision,
        r.reg_tardesc     as descu,
        r.reg_banco       as banco,
        r.reg_diferencia  as difer,
        r.reg_fecope      as fecha
        FROM registros    AS r
        ORDER BY r.id_registro DESC";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Fecha</th>
                <th scope="col" >Ticket</th>
                <th scope="col" >Valor</th>
                <th scope="col" >Iva</th>
                <th scope="col" >Neto</th>
                <th scope="col" >Rte Fte</th>
                <th scope="col" >Comision</th>
                <th scope="col" >Rte IVA</th>
                <th scope="col" >Rte ICA</th>
                <th scope="col" >Descuento</th>
                <th scope="col" >Banco</th>
                <th scope="col" >Diferencia</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($registros = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $registros['fecha'];?></td>
                <td><?php echo $registros['ticket']; ?></td>
                <td><?php echo '$ ' . number_format($registros['valor']); ?></td>
                <td><?php echo '$ ' . number_format($registros['iva']); ?></td>
                <td><?php echo '$ ' . number_format($registros['valor'] - $registros['iva']); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['retfte'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['comision'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['rteiva'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['rteica'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['descu'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['banco'])); ?></td>
                <td><?php echo '$ ' . number_format(round($registros['difer'])); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
