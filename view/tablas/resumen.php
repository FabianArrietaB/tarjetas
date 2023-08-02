<?php
    session_start();
    include "../../model/conexion.php";
    $hoy = date("Y-m-d");
    if(isset($_GET['date'])){
        $hoy = $_GET['date'];
    }
    $con = new Conexion();
    $conexion = $con->conectarbd();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        r.id_registro    as idregistro,
        r.reg_tipcuenta  as idtipcuenta,
        p.por_tipR       as tarjeta,
        r.reg_fecope     as fecha,
        SUM(r.reg_diferencia) as diferencia,
        SUM(r.reg_rtefte)     as retefuente,
        SUM(r.reg_rteiva)     as reteiva,
        SUM(r.reg_rteica)     as reteica,
        SUM(r.reg_comision)   as comision
    FROM registros  AS r
    INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
    WHERE r.reg_fecope = '$hoy'
    GROUP BY p.por_tipR";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-primary text-center">
        <thead>
            <tr>
                <th scope="col" >Tarjeta</th>
                <th scope="col" >Total Diferencia</th>
                <th scope="col" >Total ReteFuente</th>
                <th scope="col" >Total ReteIva</th>
                <th scope="col" >Total ReteIca</th>
                <th scope="col" >Total Comision</th>
            </tr>
        </thead>
        <tbody class="table-light">
        <?php
            while ($valor = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $valor['tarjeta'];?></td>
                <td><?php echo '$ ' . number_format(round($valor['diferencia']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['retefuente']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteiva']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteica']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['comision']));?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <!-- sumatoria total del reporte-->
            <td class="bg-grays-active color-palette"><b>Total </b></td>
            <td>
                <?php
                $sql=$conexion->query("SELECT round(SUM(reg_diferencia)) as 'precio' from registros where reg_fecope = '$hoy'");
                $data = mysqli_fetch_array($sql);
                $precio = $data['precio'];
                echo '$ '. number_format($precio);
                ?>
            </td>
            <td>
                <?php
                $hoy = date("Y-m-d");
                $sql=$conexion->query("SELECT round(SUM(reg_rtefte)) as 'rtefte' from registros where reg_fecope = '$hoy'");
                $data = mysqli_fetch_array($sql);
                $precio = $data['rtefte'];
                echo '$ '. number_format($precio);
                ?>
            </td>
            <td>
                <?php
                $hoy = date("Y-m-d");
                $sql=$conexion->query("SELECT round(SUM(reg_rteiva)) as 'rteiva' from registros where reg_fecope = '$hoy'");
                $data = mysqli_fetch_array($sql);
                $precio = $data['rteiva'];
                echo '$ '. number_format($precio);
                ?>
            </td>
            <td>
                <?php
                $hoy = date("Y-m-d");
                $sql=$conexion->query("SELECT round(SUM(reg_rteica)) as 'rteica' from registros where reg_fecope = '$hoy'");
                $data = mysqli_fetch_array($sql);
                $precio = $data['rteica'];
                echo '$ '. number_format($precio);
                ?>
            </td>
            <td>
                <?php
                $hoy = date("Y-m-d");
                $sql=$conexion->query("SELECT round(SUM(reg_comision)) as 'comision' from registros where reg_fecope = '$hoy'");
                $data = mysqli_fetch_array($sql);
                $precio = $data['comision'];
                echo '$ '. number_format($precio);
                ?>
            </td>
        </tfoot>
    </table>
</div>
<!-- fin de la tabla -->
