<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectarbd();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        r.id_registro   as idregistro,
        r.id_operador   as idoperador,
        r.reg_numticket as ticket,
        r.reg_tipcuenta as idtipcuenta,
        p.por_mes       as mes,
        r.reg_valor     as valor,
        r.reg_tardesc     as descu,
        r.reg_diferencia  as difer,
        r.reg_iva       as iva,
        r.reg_fecope    as fecha
        FROM registros  AS r
        INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta";
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
                <th></th>
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
                <td><?php echo '$ ' . number_format(($registros['valor'] - $registros['iva']) * 0.015); ?></td>
                <td><?php echo '$ ' . number_format(($registros['valor'] - $registros['iva']) * $registros['mes']); ?></td>
                <td><?php echo '$ ' . number_format($registros['iva'] * 0.15); ?></td>
                <td><?php echo '$ ' . number_format(($registros['valor'] - $registros['iva']) * 0.005); ?></td>
                <td><?php echo '$ ' . number_format($registros['descu']);?></td>
                <td><?php echo '$ ' . number_format($registros['valor'] - (($registros['valor'] - $registros['iva']) * $registros['mes']));?></td>
                <td><?php echo '$ ' . number_format($registros['difer']);?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar" onclick="detalleusuario('<?php echo $usuarios['idusuario']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
