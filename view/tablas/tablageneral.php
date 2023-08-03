<?php
    session_start();
    include "../../model/conexion.php";
    $hoy = "";
    $sede = "";
    if(isset($_GET['dategen'])){
        $hoy = $_GET['dategen'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    $sqlgeneral = "SELECT
        r.id_registro     as idregistro,
        r.id_operador     as idoperador,
        r.reg_tiptar      as tiptar,
        SUM(r.reg_diferencia) as diferencia,
        SUM(r.reg_rtefte)     as retefuente,
        SUM(r.reg_rteiva)     as reteiva,
        SUM(r.reg_rteica)     as reteica,
        SUM(r.reg_comision)   as comision
    FROM registros  AS r
    WHERE r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlgeneral .=" AND r.id_sede = '$sede'";
    }
    $sqlgeneral .="GROUP BY r.reg_tiptar ORDER BY r.id_registro DESC ";
    $rwgeneral = mysqli_query($conexion, $sqlgeneral);
    $sqlunico = "SELECT
        r.id_registro     AS idregistro,
        r.id_operador     AS idoperador,
        CONCAT(r.reg_tiptar, ' ' ,u.user_nombre) AS caja,
        r.reg_tiptar      AS tiptar,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision
    FROM registros  AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
    WHERE r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlunico .=" AND r.id_sede = '$sede'";
    }
    $sqlunico .="GROUP BY r.id_operador, r.reg_tiptar ORDER BY r.id_registro DESC ";
    $rwunico = mysqli_query($conexion, $sqlunico);
?>
<!-- inicio Tabla -->
<div class="row">
    <!-- <div class="col-6">
        <div class="table-responsive">
            <table class="table table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" >Tarjeta | Caja</th>
                        <th scope="col" >Diferencia</th>
                        <th scope="col" >Rte Fte</th>
                        <th scope="col" >Rte IVA</th>
                        <th scope="col" >Rte ICA</th>
                        <th scope="col" >Comision</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($valor = mysqli_fetch_array($rwgeneral)){
                    ?>
                    <tr>
                        <td><?php echo $valor['tiptar'];?></td>
                        <td><?php echo '$ ' . number_format(round($valor['diferencia']));?></td>
                        <td><?php echo '$ ' . number_format(round($valor['retefuente']));?></td>
                        <td><?php echo '$ ' . number_format(round($valor['reteiva']));?></td>
                        <td><?php echo '$ ' . number_format(round($valor['reteica']));?></td>
                        <td><?php echo '$ ' . number_format(round($valor['comision']));?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <TFoot>
                    <tr>
                        <td class="bg-grays-active color-palette"><b>Total </b></td>
                        <td>
                        <?php
                        if($sede != "" && $hoy != ""){
                            $sql=$conexion->query("SELECT round(SUM(reg_diferencia)) as 'precio' from registros where id_sede = '$sede' AND reg_fecope = '$hoy' ");
                            $data = mysqli_fetch_array($sql);
                            $precio = $data['precio'];
                            echo '$ '. number_format($precio);
                        } else {
                            echo '$ '. 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sede != "" && $hoy != ""){
                            $sql=$conexion->query("SELECT round(SUM(reg_rtefte)) as 'rtefte' from registros where id_sede = '$sede' AND reg_fecope = '$hoy'");
                            $data = mysqli_fetch_array($sql);
                            $precio = $data['rtefte'];
                            echo '$ '. number_format($precio);
                        } else {
                            
                            echo '$ '. 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($sede != "" && $hoy != ""){
                            $sql=$conexion->query("SELECT round(SUM(reg_rteiva)) as 'rteiva' from registros where id_sede = '$sede' AND reg_fecope = '$hoy'");
                            $data = mysqli_fetch_array($sql);
                            $precio = $data['rteiva'];
                            echo '$ '. number_format($precio);
                        } else {
                            
                            echo '$ '. 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sede != "" && $hoy != ""){
                            $sql=$conexion->query("SELECT round(SUM(reg_rteica)) as 'rteica' from registros where id_sede = '$sede' AND reg_fecope = '$hoy'");
                            $data = mysqli_fetch_array($sql);
                            $precio = $data['rteica'];
                            echo '$ '. number_format($precio);
                        } else {
                            
                            echo '$ '. 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($sede != "" && $hoy != ""){
                            $sql=$conexion->query("SELECT round(SUM(reg_comision)) as 'comision' from registros where id_sede = '$sede' AND reg_fecope = '$hoy'");
                            $data = mysqli_fetch_array($sql);
                            $precio = $data['comision'];
                            echo '$ '. number_format($precio);
                        } else {
                            echo '$ '. 0;
                        }
                        ?>
                    </td>
                    </tr>
                    <tr>
                        <td class="bg-grays-active color-palette">Banco</td>
                    </tr>
                    <tr>
                        <td class="bg-grays-active color-palette">Diferencia</td>
                    </tr>
                </TFoot>
            </table>
        </div>
    </div> -->
    <div class="col-12">
    <div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Tarjeta | Caja</th>
                <th scope="col" >Diferencia</th>
                <th scope="col" >Rte Fte</th>
                <th scope="col" >Rte IVA</th>
                <th scope="col" >Rte ICA</th>
                <th scope="col" >Comision</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($valor = mysqli_fetch_array($rwunico)){
            ?>
            <tr>
                <td><?php echo $valor['caja'];?></td>
                <td><?php echo '$ ' . number_format(round($valor['diferencia']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['retefuente']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteiva']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteica']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['comision']));?></td>
            </tr>
            <?php } ?>
        </tbody>
        <TFoot>
            <?php while ($valor = mysqli_fetch_array($rwgeneral)){ ?>
            <tr>
                <td>Total</td>
                <tr>
                
                    <td><?php echo $valor['diferencia'];?></td>
                
                </tr>
            </tr>
            <?php } ?>
        </TFoot>
    </table>
</div>
    </div>
</div>



<!-- fin de la tabla -->
