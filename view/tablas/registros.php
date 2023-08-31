<?php
    session_start();
    if ($_SESSION['usuario']['rol'] == 4) {
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
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
        r.reg_estado      as estado,
        r.reg_fecope      as fecha
        FROM registros    AS r
        ORDER BY r.id_registro DESC";
    $query = mysqli_query($conexion, $sql);
} else {
     include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
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
        r.reg_estado      as estado,
        r.reg_fecope      as fecha
        FROM registros    AS r
        WHERE r.id_operador = '$idusuario'
        ORDER BY r.id_registro DESC";
    $query = mysqli_query($conexion, $sql);
}
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Fecha</th>
                <th scope="col" >Ticket</th>
				<th scope="col" >Tipo</th>
				<th scope="col" >Franquicia</th>
                <th scope="col" >Valor</th>
                <th scope="col" >Iva</th>
                <th scope="col" >Neto</th>
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
				<td><?php echo $registros['idtipcuenta']; ?></td>
				<td><?php echo $registros['tiptar']; ?></td>
                <td><?php echo '$ ' . number_format($registros['valor']); ?></td>
                <td><?php echo '$ ' . number_format($registros['iva']); ?></td>
                <td><?php echo '$ ' . number_format($registros['valor'] - $registros['iva']); ?></td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#editar"  type="button" class="btn btn-warning" onclick="detalleregistro('<?php echo $registros['idregistro']?>')"><i class="fa-solid fa-pen-to-square fa-xl"></i></button>
                
                <?php
                    if ($registros['estado'] == 1) {
                    ?>
                        <button data-bs-toggle="modal" data-bs-target="#elireg" class="btn btn-danger" onclick="detalleeliminacionregistro(<?php echo $registros['idregistro'] ?>)"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                    <?php
                    } else if ($registros['estado'] == 0) {
                        ?>
                        <button data-bs-toggle="modal" data-bs-target="#elireg"  class="btn btn-success" onclick="detalleeliminacionregistro(<?php echo $registros['idregistro'] ?>?>)"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                    <?php
                    }
                ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
