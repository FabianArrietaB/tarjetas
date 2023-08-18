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
    $idusuario = $_SESSION['usuario']['id'];
    //CONSULTA DIFERENCIA
    $sqldiferencia = "SELECT
        c.con_franquicia as franquisia,
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
    WHERE c.id_sede = '$sede' AND c.con_fecconcil BETWEEN '$desde' AND '$hasta'";
    if($master != ""){
        $sqldiferencia .=" AND c.con_franquisia = '$master'";
    }
    if($visa != ""){
        $sqldiferencia .=" OR c.con_franquisia = '$visa'";
    }
    if($davi != ""){
        $sqldiferencia .=" OR c.con_franquisia = '$davi'";
    }
    $sqldiferencia .="GROUP BY c.con_franquisia";
    $query = mysqli_query($conexion, $sqldiferencia);
    $mes =  substr($desde,5,2);
    if ($mes == 1) {
        $nommes = 'ENERO';
    } else if ($mes == 2){
        $nommes = 'FEBRERO';
    } else if ($mes == 3){
        $nommes = 'MARZO';
    } else if ($mes == 4){
        $nommes = 'ABRIL';
    } else if ($mes == 5){
        $nommes = 'MAYO';
    }else if ($mes == 6){
        $nommes = 'JUNIO';
    }else if ($mes == 7){
        $nommes = 'JULIO';
    }else if ($mes == 8){
        $nommes = 'AGOSTO';
    }else if ($mes == 9){
        $nommes = 'SEPTIEMBRE';
    }else if ($mes == 10){
        $nommes = 'OCTUBRE';
    }else if ($mes == 11){
        $nommes = 'NOVIEMBRE';
    }else if ($mes == 12){
        $nommes = 'DICIEMBRE';
    }
?>
<!-- inicio Tabla -->
<?php if($mes != "" && $sede !="") { ?>
<div class="row mb-3 text-center">
    <?php if($master == "" && $visa == "" && $davi == "") { ?>
        <div class="col-9">
            <legend  class="group-border"><b>CONCILIACION MES <?php echo $nommes ?></b> </legend>
        </div>
        <div class="col-3">
            <div class="input-group ">
                <span class="input-group-text" id="inputGroup-sizing-default">Total General</span>
                <input type="text" class="form-control" tabindex="2" maxlength="10" size="20" value="
                <?php
                    $sql=$conexion->query("SELECT ROUND(SUM(con_difenuevo)) AS 'precio' FROM conciliacion WHERE id_sede = '$sede' AND con_fecconcil BETWEEN '$desde' AND '$hasta'");
                    $data = mysqli_fetch_array($sql);
                    $precio = $data['precio'];
                    echo $precio;
                ?>
                ">
            </div>
        </div>
    <?php } else { ?>
        <div class="col-9">
            <legend  class="group-border"><b>CONCILIACION MES <?php echo $nommes ?></b> </legend>
        </div>
        <div class="col-3">
            <div class="input-group ">
                <span class="input-group-text" id="inputGroup-sizing-default">Total General</span>
                <input type="text" class="form-control" tabindex="2" maxlength="10" size="20" value="
                <?php
                    if($master !="" && $visa ="" && $davi == "" ){
                        $sql=$conexion->query("SELECT ROUND(SUM(con_difenuevo)) AS 'precio' FROM conciliacion WHERE id_sede = '$sede' AND con_fecconcil BETWEEN '$desde' AND '$hasta' AND con_franquicia = '$master'");
                        $data = mysqli_fetch_array($sql);
                        $precio = $data['precio'];
                        echo $precio;
                    } else if ($master !="" && $visa !="" && $davi == "" ){
                        $sql=$conexion->query("SELECT ROUND(SUM(con_difenuevo)) AS 'precio' FROM conciliacion WHERE id_sede = '$sede' AND con_fecconcil BETWEEN '$desde' AND '$hasta' AND con_franquicia IN('$master', '$visa')");
                        $data = mysqli_fetch_array($sql);
                        $precio = $data['precio'];
                        echo $precio;
                    } else if ($master !="" && $visa !="" && $davi != "" ){
                        $sql=$conexion->query("SELECT ROUND(SUM(con_difenuevo)) AS 'precio' FROM conciliacion WHERE id_sede = '$sede' AND con_fecconcil BETWEEN '$desde' AND '$hasta' AND con_franquicia IN('$master', '$visa', '$davi')");
                        $data = mysqli_fetch_array($sql);
                        $precio = $data['precio'];
                        echo $precio;
                    }
                ?>
                ">
            </div>
        </div>
    <?php } ?>
</div>

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
            $total = 0;
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
                            <tr>
                                <td class="bg-primary" style="color:#fff"><b><?php echo 'TOTAL DIFERENCIA ' . $tipo_tarjeta?></b></td>
                                <td class="bg-primary" style="color:#fff"></td>
                                <td class="bg-primary" style="color:#fff"></td>
                                <td class="bg-primary" style="color:#fff"><b><?php echo '$ ' . number_format(round($diferenciafte + $diferenciarteiva + $diferenciarteica + $diferenciacomisi - $diferencia)) ?></b></td>
                                <td class="bg-primary" style="color:#fff"></td>
                                <td class="bg-primary" style="color:#fff"></td>
                            </tr>
                        <?php
                            $total = 0;
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
                            $total = $valor['newdiferen'];
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
            <tr>
                <td class="bg-primary" style="color:#fff"><b><?php echo 'TOTAL DIFERENCIA ' . $tipo_tarjeta?></b></td>
                <td class="bg-primary" style="color:#fff"></td>
                <td class="bg-primary" style="color:#fff"></td>
                <td class="bg-primary" style="color:#fff"><b><?php echo '$ ' . number_format(round($diferenciafte + $diferenciarteiva + $diferenciarteica + $diferenciacomisi - $diferencia)) ?></b></td>
                <td class="bg-primary" style="color:#fff"></td>
                <td class="bg-primary" style="color:#fff"></td>
            </tr>
        </tbody>
    </table>
</div>
<?php } else {
    echo "No hay Datos que Mostrar Seleccione Mes y Sede Consulta"
?>
<?php } ?>