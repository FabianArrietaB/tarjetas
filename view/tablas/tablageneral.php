<?php
    session_start();
    include "../../model/conexion.php";
    $hoy = "";
    $sede = "";
    $franquicia = "";
    if(isset($_GET['dategen'])){
        $hoy = $_GET['dategen'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    if(isset($_GET['franquicia'])){
        $franquicia = $_GET['franquicia'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
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
    WHERE r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlunico .=" AND r.id_sede = '$sede'";
    }
    $sqlunico .="GROUP BY r.reg_tiptar, r.id_operador";
    $rwunico = mysqli_query($conexion, $sqlunico);
    //CONSULTA DIFERENCIA
    $sqldiferencia = "SELECT
    r.id_registro     AS idregistro,
    r.id_operador     AS idoperador,
    r.reg_tiptar          AS tiptar,
    SUM(r.reg_diferencia) AS diferencia,
    SUM(r.reg_rtefte)     AS retefuente,
    SUM(r.reg_rteiva)     AS reteiva,
    SUM(r.reg_rteica)     AS reteica,
    SUM(r.reg_comision)   AS comision
FROM registros AS r
INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
WHERE r.reg_fecope = '$hoy' AND r.reg_tiptar = '$franquicia' AND r.id_sede = '$sede'";
$querydiferencia = mysqli_query($conexion, $sqldiferencia);
$rwdiferencia = mysqli_fetch_array($querydiferencia);
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
        <fieldset class="group-border">
            <legend  class="group-border">Diferencia <?php echo $rwdiferencia['tiptar'] ?> </legend>
            <div class="row text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bddif" name="bddif" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['diferencia']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bandif" name="bandif" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dif" name="dif" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdrte" name="bdrte" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['retefuente']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banrte" name="banrte" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrte" name="difrte" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdiva" name="bdiva" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteiva']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="baniva" name="baniva" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difiva" name="difiva" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdica" name="bdica" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteica']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banica" name="banica" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difica" name="difica" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdcom" name="bdcom" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['comision']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="bancom" class="form-control text-center input-sm" placeholder="Ingrese Diferencia Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difcom" name="difcom" class="form-control text-center input-sm" placeholder="Diferencia Registros" >
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Fecha Registro</label>
                        <input type="date" class="form-control"  name="fecha" id="fecha" required>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="col-12">
            <div >
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</form>
<script>
    let bddif = document.getElementById("bddif")
    let dif = document.getElementById("dif")
    let bandif = document.getElementById("bandif")
    bandif.addEventListener("change", () => {
        round(dif.value) = parseFloat(bddif.value) - parseFloat(bandif.value)
    })
</script>
<?php } else {
    echo "No hay Datos que Mostrar"
?>
<?php } ?>

<!-- fin de la tabla -->
