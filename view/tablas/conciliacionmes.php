<?php
    session_start();
    include "../../model/conexion.php";
    $mes = "";
    $sede = "";
    if(isset($_GET['mes'])){
        $mes = $_GET['mes'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    //CONSULTA DIFERENCIA
    $sqldiferencia = "SELECT
    c.con_franquisia as franquisia,
    SUM(c.con_difenuevo)  as newdiferen,
    SUM(c.con_rteftenew)  as newretfuen,
    SUM(c.con_rteivanew)  as newreteiva,
    SUM(c.con_rteicanew)  as newreteica,
    SUM(c.con_comisinew)  as newcomisio,
    SUM(C.con_difebanco)  as bandiferen,
    SUM(c.con_rtefteban)  as banrtefte,
    SUM(c.con_rteivaban)  as banrteiva,
    SUM(c.con_rteicaban)  as banretecia,
    SUM(c.con_comisiban)  as bancomisi,
    c.con_fecconcil  as fechaconci
    FROM conciliacion AS c
    WHERE  c.id_sede = '$sede'
    GROUP BY c.con_franquisia";
$query = mysqli_query($conexion, $sqldiferencia);
if ($mes = 7) {
    $nommes = 'JULIO';
}
?>
<!-- inicio Tabla -->
<legend  class="group-border"><b>CONCILIACION MES <?php echo $nommes ?></b> </legend>
<div class="table-responsive">
    <table class="table table-primary text-center">
        <thead>
            <tr>
                <th scope="col" >FRANQUISIA</th>
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
                if ($tipo_tarjeta != $valor['franquisia']) {
                    if ($tipo_tarjeta != '') { ?>
                            <tr>
                                <td class="table-info"><b><?php echo 'DIFERENCIA ' . $tipo_tarjeta?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferencia));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciafte));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciarteiva));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciarteica));?></b></td>
                                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciacomisi));?></b></td>
                            </tr>
                        <?php
                            $diferencia = 0;
                            $diferenciafte = 0;
                            $diferenciarteiva = 0;
                            $diferenciarteica = 0;
                            $diferenciacomisi = 0;
                    }
                        $tipo_tarjeta = $valor['franquisia'];
                }
                            $diferencia = $valor['bandiferen'] - $valor['newdiferen'];
                            $diferenciafte = $valor['banrtefte'] - $valor['newretfuen'];
                            $diferenciarteiva = $valor['banrteiva'] - $valor['newreteiva'];
                            $diferenciarteica = $valor['banretecia'] - $valor['newreteica'];
                            $diferenciacomisi = $valor['bancomisi'] - $valor['newcomisio'];
                        ?>
                        <tr>
                            <td class="bg--light" ><b><?php echo 'VALOR REGISTRO ' . $valor['franquisia'];?></b></td>
                            <td><?php echo '$ ' . number_format(round($valor['newdiferen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newretfuen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newreteiva']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newreteica']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['newcomisio']));?></td>
                        </tr>
                        <tr>
                            <td class="bg--light" ><b><?php echo 'VALOR BANCO ' . $valor['franquisia'];?></b></td>
                            <td><?php echo '$ ' . number_format(round($valor['bandiferen']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banrtefte']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banrteiva']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['banretecia']));?></td>
                            <td><?php echo '$ ' . number_format(round($valor['bancomisi']));?></td>
                        </tr>
            <?php } ?>
            <tr>
                <td class="table-info"><b><?php echo 'DIFERENCIA ' . $tipo_tarjeta?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferencia));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciafte));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciarteiva));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciarteica));?></b></td>
                <td class="table-info"><b><?php echo '$ ' . number_format(round($diferenciacomisi));?></b></td>
            </tr>
        </tbody>
    </table>
</div>
