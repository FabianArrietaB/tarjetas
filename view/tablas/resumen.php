<?php
    session_start();
    if ($_SESSION['usuario']['tarrol'] == 4 ||
        $_SESSION['usuario']['tarrol'] == 2) {
    include "../../model/conexion.php";
    $hoy = date("Y-m-d");
    $usuario = "";
    if(isset($_GET['date'])){
        $hoy = $_GET['date'];
    }
    if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    if($usuario == ""){
        $sql = "SELECT
            r.id_registro    as idregistro,
            r.reg_tipcuenta  as idtipcuenta,
            p.por_tipR       as tarjeta,
            r.reg_fecope     as fecha,
            SUM(r.reg_tardesc) as tardescuento,
            SUM(r.reg_diferencia) as diferencia,
            SUM(r.reg_rtefte)     as retefuente,
            SUM(r.reg_rteiva)     as reteiva,
            SUM(r.reg_rteica)     as reteica,
            SUM(r.reg_comision)   as comision
        FROM registros  AS r
        INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
        WHERE r.reg_estado = 1 AND r.reg_fecope = '$hoy'
        GROUP BY p.por_tipR";
        $query = mysqli_query($conexion, $sql);
    }else{
        $sql = "SELECT
            r.id_registro    as idregistro,
            r.reg_tipcuenta  as idtipcuenta,
            p.por_tipR       as tarjeta,
            r.reg_fecope     as fecha,
            SUM(r.reg_tardesc) as tardescuento,
            SUM(r.reg_diferencia) as diferencia,
            SUM(r.reg_rtefte)     as retefuente,
            SUM(r.reg_rteiva)     as reteiva,
            SUM(r.reg_rteica)     as reteica,
            SUM(r.reg_comision)   as comision
        FROM registros  AS r
        INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
        WHERE r.reg_estado = 1 AND r.reg_fecope = '$hoy' AND r.id_operador =  $usuario
        GROUP BY p.por_tipR";
        $query = mysqli_query($conexion, $sql);
    }
    
} else {
    include "../../model/conexion.php";
    $hoy = date("Y-m-d");
    if(isset($_GET['date'])){
        $hoy = $_GET['date'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sede = $_SESSION['usuario']['tarsede'];
    $sql = "SELECT
        r.id_registro    as idregistro,
        r.reg_tipcuenta  as idtipcuenta,
        p.por_tipR       as tarjeta,
        r.reg_fecope     as fecha,
        SUM(r.reg_tardesc) as tardescuento,
        SUM(r.reg_diferencia) as diferencia,
        SUM(r.reg_rtefte)     as retefuente,
        SUM(r.reg_rteiva)     as reteiva,
        SUM(r.reg_rteica)     as reteica,
        SUM(r.reg_comision)   as comision
    FROM registros  AS r
    INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
    WHERE r.reg_estado = 1 AND r.reg_fecope = '$hoy'";
    if($sede = "1"){
        $sql .=" AND r.id_operador = '$idusuario'";
    }
    if($sede != "1"){
        $sql .=" AND r.id_sede = '$sede'";
    }
    $sql .="GROUP BY p.por_tipR";
    $query = mysqli_query($conexion, $sql);
}
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
                <th scope="col" class="bg-danger" style="color:#fff">Descuento</th>
                <th scope="col" class="bg-success" style="color:#fff">Total</th>
            </tr>
        </thead>
        <tbody class="table-light">
        <?php
            while ($valor = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td class="bg--light" ><?php echo $valor['tarjeta'];?></td>
                <td><?php echo '$ ' . number_format(round($valor['diferencia']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['retefuente']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteiva']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteica']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['comision']));?></td>
                <td class="bg-danger" style="color:#fff"><?php echo '$ ' . number_format(round($valor['tardescuento']));?></td>
                <td class="bg-success" style="color:#fff"><?php echo '$ ' . number_format(round($valor['diferencia'] + $valor['retefuente'] + $valor['reteiva'] + $valor['reteica'] + $valor['comision']));?></td>
            </tr>
        <?php } ?>
        </tbody>
        
        <tfoot>
            <!-- sumatoria total del reporte-->
            <td class="bg-grays-active color-palette"><b>Total </b></td>
            <td>
                <?php
                if ($_SESSION['usuario']['tarrol'] == 4) {
                    if($usuario != ''){
                        $sql=$conexion->query("SELECT round(SUM(reg_diferencia)) as 'precio' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                    } else  {
                        $sql=$conexion->query("SELECT round(SUM(reg_diferencia)) as 'precio' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                    }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['precio'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_diferencia)) as 'precio' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy' ");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['precio'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td>
                <?php
                    if ($_SESSION['usuario']['tarrol'] == 4) {
                        if($usuario != ''){
                            $sql=$conexion->query("SELECT round(SUM(reg_rtefte)) as 'rtefte' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                        }else {
                            $sql=$conexion->query("SELECT round(SUM(reg_rtefte)) as 'rtefte' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                        }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rtefte'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_rtefte)) as 'rtefte' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rtefte'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td>
                <?php
                    if ($_SESSION['usuario']['tarrol'] == 4) {
                        if($usuario != ''){
                            $sql=$conexion->query("SELECT round(SUM(reg_rteiva)) as 'rteiva' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                        }else {
                            $sql=$conexion->query("SELECT round(SUM(reg_rteiva)) as 'rteiva' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                        }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rteiva'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_rteiva)) as 'rteiva' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rteiva'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td>
                <?php
                if ($_SESSION['usuario']['tarrol'] == 4) {
                    if($usuario != ''){
                        $sql=$conexion->query("SELECT round(SUM(reg_rteica)) as 'rteica' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                    }else {
                        $sql=$conexion->query("SELECT round(SUM(reg_rteica)) as 'rteica' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                    }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rteica'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_rteica)) as 'rteica' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['rteica'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td>
                <?php
                if ($_SESSION['usuario']['tarrol'] == 4) {
                    if($usuario != ''){
                        $sql=$conexion->query("SELECT round(SUM(reg_comision)) as 'comision' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                    }else {
                        $sql=$conexion->query("SELECT round(SUM(reg_comision)) as 'comision' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                    }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['comision'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_comision)) as 'comision' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['comision'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td class="bg-danger" style="color:#fff">
                <?php
                if ($_SESSION['usuario']['tarrol'] == 4) {
                    if($usuario != ''){
                        $sql=$conexion->query("SELECT round(SUM(reg_tardesc)) as 'total' from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                    }else {
                        $sql=$conexion->query("SELECT round(SUM(reg_tardesc)) as 'total' from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                    }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['total'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_tardesc)) as 'total' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['total'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
            <td class="bg-success" style="color:#fff">
                <?php
                if ($_SESSION['usuario']['tarrol'] == 4) {
                    if($usuario != ''){
                        $sql=$conexion->query("SELECT round(SUM(reg_diferencia) + SUM(reg_rtefte) + SUM(reg_rteiva) + SUM(reg_rteica) + SUM(reg_comision))  as 'total'  from registros where reg_estado = 1 AND reg_fecope = '$hoy' AND id_operador = '$usuario'");
                    }else {
                        $sql=$conexion->query("SELECT round(SUM(reg_diferencia) + SUM(reg_rtefte) + SUM(reg_rteiva) + SUM(reg_rteica) + SUM(reg_comision))  as 'total'  from registros where reg_estado = 1 AND reg_fecope = '$hoy'");
                    }
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['total'];
                    echo '$ '. number_format($precio);
                } else {
                    $sql=$conexion->query("SELECT round(SUM(reg_diferencia) + SUM(reg_rtefte) + SUM(reg_rteiva) + SUM(reg_rteica) + SUM(reg_comision))  as 'total' from registros where reg_estado = 1 AND id_operador = '$idusuario' AND reg_fecope = '$hoy'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['total'];
                    echo '$ '. number_format($precio);
                }
                ?>
            </td>
        </tfoot>
    </table>
</div>
<!-- fin de la tabla -->
