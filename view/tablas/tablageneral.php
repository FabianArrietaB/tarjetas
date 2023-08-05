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
    $sqlunico = "SELECT
        r.id_registro     AS idregistro,
        r.id_operador     AS idoperador,
        CONCAT(r.reg_tiptar, ' ' ,u.user_nombre) AS caja,
        r.reg_tiptar          AS tiptar,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision,
        t.totaldiferecias	    AS totaldiferecias
    FROM registros AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador,
    (SELECT SUM(reg_diferencia) AS totaldiferecias FROM registros WHERE reg_fecope = '$hoy') AS t
    WHERE r.reg_fecope = '$hoy'";
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
<form id="frmadddiferencia" method="post" onsubmit="return adddiferencia()">
    <div  class="row text-center">
        <fieldset id="difmas" class="group-border">
            <legend  class="group-border">Diferencia Mastercard</legend>
            <div class="row text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bddifmas" name="bddifmas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bandifmas" name="bandifmas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difmas" name="difmas" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdrtemas" name="bdrtemas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banrtemas" name="banrtemas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrtemas" name="difrtemas" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdivamas" name="bdivamas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banivamas" name="banivamas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difivamas" name="difivamas" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdicamas" name="bdicamas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banicamas" name="banicamas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dificamas" name="dificamas" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdcommas" name="bdcommas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancommas" name="bancommas" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difcommas" name="difcommas" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset id="difvis" class="group-border">
            <legend class="group-border">Diferencia Visa</legend>
            <div class="row text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bddifvis" name="bddifvis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bandifvis" name="bandifvis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difvis" name="difvis" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdrtevis" name="bdrtevis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banrtevis" name="banrtevis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrtevis" name="difrtevis" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdivavis" name="bdivavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banivavis" name="banivavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difivavis" name="difivavis" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdicavis" name="bdicavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banicavis" name="banicavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dificavis" name="dificavis" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdicavis" name="bdicavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banicavis" name="banicavis" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dificavis" name="dificavis" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset id="difdav" class="group-border">
            <legend class="group-border">Diferencia DAVIVIENDA</legend>
            <div class="row text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bddifdav" name="bddifdav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bandifdav" name="bandifdav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difdav" name="difdav" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdrtedav" name="bdrtedav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banrtedav" name="banrtedav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrtedav" name="difrtedav" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdivadav" name="bdivadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banivadav" name="banivadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difivadav" name="difivadav" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdicadav" name="bdicadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banicadav" name="banicadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dificadav" name="dificadav" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdicadav" name="bdicadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Sistema" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banicadav" name="banicadav" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dificadav" name="dificadav" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="col-12">
            <div >
                <button type="submit" class="btn btn-success" >Guardar</button>
            </div>
        </div>
    </div>
</form>
<?php } else {
    echo "No hay Datos que Mostrar"
?>
<?php } ?>

<!-- fin de la tabla -->
