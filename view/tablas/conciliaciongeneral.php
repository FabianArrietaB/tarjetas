<?php
    session_start();
    include "../../model/conexion.php";
    $desde = "";
    $hasta = "";
    $sede = "";
    $master = "";
    $visa = "";
    $davi = "";
    if(isset($_GET['desde']) && ($_GET['hasta'])){
        $desde = $_GET['desde'];
        $hasta = $_GET['hasta'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    if(isset($_GET['master'])){
        $master = $_GET['master'];
    }
    if(isset($_GET['visa'])){
        $visa = $_GET['visa'];
    }
    if(isset($_GET['davi'])){
        $davi = $_GET['davi'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    //CONSULTA DIFERENCIA
    $sqldiferencia = "SELECT
        c.con_franquicia AS franquicia,
        c.con_difenuevo  AS newdiferen,
        c.con_rteftenew  AS newretfuen,
        c.con_rteivanew  AS newreteiva,
        c.con_rteicanew  AS newreteica,
        c.con_comisinew  AS newcomisio,
        C.con_difebanco  AS bandiferen,
        c.con_rtefteban  AS banrtefte,
        c.con_rteivaban  AS banrteiva,
        c.con_rteicaban  AS banretecia,
        c.con_comisiban  AS bancomisi,
        c.con_fecconcil  AS fechaconci
    FROM conciliacion AS c
    WHERE c.id_sede = '$sede' AND c.con_fecconcil BETWEEN '$desde' AND '$hasta'
    AND c.con_estado = 1";
    if($master != "" && $visa == "" && $davi == ""){
    $sqldiferencia .=" AND c.con_franquicia = '$master'";
    } else if ($master == "" && $visa !="" && $davi == "" ){
        $sqldiferencia .=" AND c.con_franquicia = '$visa'";
    } else if ($master == "" && $visa == "" && $davi != "" ){
        $sqldiferencia .=" AND c.con_franquicia = '$davi'";
    } else if ($master !="" && $visa !="" && $davi == "" ){
        $sqldiferencia .=" AND c.con_franquicia IN ('$master', '$visa')";
    } else if ($master !="" && $visa == "" && $davi != "" ){
        $sqldiferencia .=" AND c.con_franquicia IN ('$master', '$davi')";
    } else if ($master == "" && $visa != "" && $davi != "" ){
        $sqldiferencia .=" AND c.con_franquicia IN ('$davi', '$visa')";
    }
$query = mysqli_query($conexion, $sqldiferencia);
?>
<!-- inicio Tabla -->
<?php if($desde != "" && $hasta != "" && $sede !="") { ?>
<legend  class="group-border"><b>CONCILIACION DESDE <?php echo $desde ?> HASTA <?php echo $hasta ?></b> </legend>
<div class="table-responsive">
    <table class="table table-primary text-center">
        <thead>
            <tr>
                <th scope="col" >FRANQUICIA</th>
                <th scope="col" >Total Diferencia</th>
                <th scope="col" >Total ReteFuente</th>
                <th scope="col" >Total ReteIva</th>
                <th scope="col" >Total ReteIca</th>
                <th scope="col" >Total Comision</th>
            </tr>
        </thead>
        <tbody class="table-light">
        <?php
            $tipo_tarjeta = '';
            $diferencia = 0;
            $diferenciafte = 0;
            $diferenciarteiva = 0;
            $diferenciarteica = 0;
            $diferenciacomisi = 0;
            while ($valor = mysqli_fetch_array($query)){
                if ($tipo_tarjeta != $valor['franquicia']) {
                    if ($tipo_tarjeta != '') { ?>
                        <?php
                            $diferencia = 0;
                            $diferenciafte = 0;
                            $diferenciarteiva = 0;
                            $diferenciarteica = 0;
                            $diferenciacomisi = 0;
                    }
                        $tipo_tarjeta = $valor['franquicia'];
                }
                            $diferencia = $valor['bandiferen'] - $valor['newdiferen'];
                            $diferenciafte = $valor['banrtefte'] - $valor['newretfuen'];
                            $diferenciarteiva = $valor['banrteiva'] - $valor['newreteiva'];
                            $diferenciarteica = $valor['banretecia'] - $valor['newreteica'];
                            $diferenciacomisi = $valor['bancomisi'] - $valor['newcomisio'];
                        ?>
                        <tr>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;"><b>FECHA PROCESO</b></td>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;" ><b><?php echo $valor['fechaconci'];?></b></td>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-danger" style="--bs-bg-opacity: .5;"></td>
                        </tr>
                        <tr>
                            <td class="bg-light" ><b><?php echo 'VALOR REGISTRO ' . $valor['franquicia'];?></b></td>
                            <td><?php echo '$ ' . number_format(round($valor['newdiferen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newretfuen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newreteiva']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newreteica']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newcomisio']));?></td>
                        </tr>
                        <tr>
                            <td class="bg--light" ><b><?php echo 'VALOR BANCO ' . $valor['franquicia'];?></b></td>
                            <td><?php echo '$ ' . number_format(round($valor['bandiferen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banrtefte']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banrteiva']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banretecia']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['bancomisi']));?></td>
                        </tr>
                        <tr>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo 'DIFERENCIA ' . $tipo_tarjeta?></b></td>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferencia));?></b></td>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferenciafte));?></b></td>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferenciarteiva));?></b></td>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferenciarteica));?></b></td>
                            <td class="bg-success" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferenciacomisi));?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"><b><?php echo 'TOTAL DIFERENCIA ' . $tipo_tarjeta?></b></td>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"><b><?php echo '$ ' . number_format(round($diferencia - $diferenciafte + $diferenciarteiva + $diferenciarteica + $diferenciacomisi)) ?></b></td>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"></td>
                            <td class="bg-warning" style="--bs-bg-opacity: .5;"></td>
                        </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } else {
    echo "Seleccione Rango Fecha y Sede para Generar una Consulta"
?>
<?php } ?>