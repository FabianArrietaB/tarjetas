<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        r.id_registro   idregistro,
        s.sed_nombre    sede,
        r.id_operador   idoperador,
        u.user_nombre   nombre,
        r.reg_numticket ticket,
        h.his_fecope    feceli,
        h.his_detall   detall,
        r.reg_estado    estado,
        r.reg_fecope    fecha
        FROM registros r
        INNER JOIN usuarios u ON u.id_usuario = r.id_operador
        INNER JOIN historial h ON h.his_numdoc = r.reg_numticket
        INNER JOIN sedes s ON s.id_sede = r.id_sede
        WHERE r.reg_estado = 0
        ORDER BY r.id_registro DESC";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<?php if(mysqli_num_rows($query) > 0) { ?>
<div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Fecha</th>
                <th scope="col" >Ticket</th>
                <th scope="col" >Sede</th>
                <th scope="col" >Operador</th>
                <th scope="col" >Fecha Registro</th>
                <th scope="col" >Fecha Elimacion</th>
                <th scope="col" >Observacion</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($registros = mysqli_fetch_array($query)){
        ?>
            <tr onclick="actrivarregistro(<?php echo $registros['idregistro'] ?>, <?php echo $registros['estado'] ?>)">
                <td><?php echo $registros['fecha'];?></td>
                <td><?php echo $registros['ticket']; ?></td>
                <td><?php echo $registros['sede']; ?></td>
				<td><?php echo $registros['nombre']; ?></td>
				<td><?php echo $registros['fecha']; ?></td>
                <td><?php echo $registros['feceli']; ?></td>
                <td><?php echo $registros['detall']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php } else {
    echo "No hay Datos que Mostrar"
?>
<?php } ?>

<!-- fin de la tabla -->
