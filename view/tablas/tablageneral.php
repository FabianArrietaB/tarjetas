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
    $idusuario = $_SESSION['usuario']['tarid'];
    //CONSULTA RESUMEN
    $sqlunico = "SELECT
        r.id_registro     AS idregistro,
        r.id_operador     AS idoperador,
        CONCAT(r.reg_tiptar, ' ' ,u.user_nombre) AS caja,
        r.reg_tiptar          AS tiptar,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision
    FROM registros AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
    WHERE r.reg_estado = 1 AND r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlunico .=" AND r.id_sede = '$sede'";
    }
    $sqlunico .="GROUP BY r.reg_tiptar, r.id_operador";
    $rwunico = mysqli_query($conexion, $sqlunico);
?>
<!-- inicio Tabla -->
<?php if(mysqli_num_rows($rwunico) > 0) { ?>
<div class="table-responsive">
    <table class="table table-primary text-center">
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
        <tbody class="table-light">
            <?php
            $tipo_tarjeta = '';
            $sub_total = 0;
            $totalrtefte = 0;
            $totalrteiva = 0;
            $totalrteica = 0;
            $totalcomisi = 0;
            while ($valor = mysqli_fetch_array($rwunico)) {
                if ($tipo_tarjeta != $valor['tiptar']) {
                    if ($tipo_tarjeta != '') { ?>
                            <tr>
                                <td class="table-info"><b><?php echo 'TOTAL ' . $tipo_tarjeta?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($sub_total));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrtefte));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrteiva));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrteica));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalcomisi));?></b></td>
                            </tr>
                        <?php
                            $sub_total = 0;
                            $totalrtefte = 0;
                            $totalrteiva = 0;
                            $totalrteica = 0;
                            $totalcomisi = 0;
                    }
                        $tipo_tarjeta = $valor['tiptar'];
                }
                            $sub_total += $valor['diferencia'];
                            $totalrtefte += $valor['retefuente'];
                            $totalrteiva += $valor['reteiva'];
                            $totalrteica += $valor['reteica'];
                            $totalcomisi += $valor['comision'];
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
            <tr>
                <td class="table-info"><b><?php echo 'TOTAL ' . $tipo_tarjeta?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($sub_total));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrtefte));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrteiva));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalrteica));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($totalcomisi));?></b></td>
            </tr>
        </tbody>
    </table>
</div>
<?php } else {
    echo "No hay Datos que Mostrar"
?>
<?php } ?>

<!-- fin de la tabla -->
