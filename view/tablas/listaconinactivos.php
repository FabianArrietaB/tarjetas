<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        c.id_conciliacion idconciliacion,
        s.sed_nombre      sede,
        c.id_operador     idoperador,
        u.user_nombre     nombre,
        h.his_fecope      feceli,
        h.his_detall      detall,
        c.con_estado      estado,
        c.con_fecconcil   fecha
    FROM conciliacion c
    INNER JOIN usuarios u ON u.id_usuario =  c.id_operador
    INNER JOIN historial h ON h.his_numdoc = c.id_conciliacion
    INNER JOIN sedes s ON s.id_sede = c.id_sede
    WHERE c.con_estado = 0
    ORDER BY c.id_conciliacion DESC";
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
            <tr onclick="activarconciliacion(<?php echo $registros['idconciliacion'] ?>, <?php echo $registros['estado'] ?>)">
                <td><?php echo $registros['fecha'];?></td>
                <td><?php echo str_pad($registros['idconciliacion'], 3, "0", STR_PAD_LEFT); ?></td>
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