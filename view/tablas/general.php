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
    $idusuario = $_SESSION['usuario']['tarid'];
    //CONSULTA DIFERENCIA
    $sqldiferencia = "SELECT
        r.id_sede         AS idsede,
        s.sed_nombre      AS sede,
        r.id_registro     AS idregistro,
        r.id_tipregistro     AS idtipregistro,
        r.id_operador     AS idoperador,
        r.reg_tiptar          AS tiptar,
        r.reg_estado          AS estado,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision
    FROM registros AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
    INNER JOIN sedes AS s On r.id_sede = s.id_sede
    WHERE r.reg_estado = 1 AND r.id_tipregistro = 1 AND r.reg_fecope = '$hoy' AND r.reg_tiptar = '$franquicia' AND r.id_sede = '$sede'";
    $querydiferencia = mysqli_query($conexion, $sqldiferencia);
    $rwdiferencia = mysqli_fetch_array($querydiferencia);
    //CONSULTA DOMICILIOS
    $sqldomicilio = "SELECT
        r.id_sede         AS idsede,
        s.sed_nombre      AS sede,
        r.id_registro     AS idregistro,
        r.id_tipregistro     AS idtipregistro,
        r.id_operador     AS idoperador,
        r.reg_tiptar          AS tiptar,
        r.reg_estado          AS estado,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision
    FROM registros AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
    INNER JOIN sedes AS s On r.id_sede = s.id_sede
    WHERE r.reg_estado = 1 AND r.id_tipregistro = 2 AND r.reg_fecope = '$hoy' AND r.reg_tiptar = '$franquicia' AND r.id_sede = '$sede'";
    $querydomicilio = mysqli_query($conexion, $sqldomicilio);
    $rwdomicilio = mysqli_fetch_array($querydomicilio);
?>
<!-- inicio Tabla -->
<?php if($sede != "") { ?>
<form id="frmadddiferencia" method="post" onsubmit="return validardiferencia()">
    <div class="row text-center">
        <fieldset class="group-border">
            <legend class="group-border text-center"><b>CONCILIACION <?php echo $hoy ?></b> </legend>
            <div class="row student">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">SEDE | FRANQUICIA</span>
                        <input hidden id="sede" name="sede" type="text" class="form-control text-center input-sm" value="<?php echo $sede ?>" readonly>
                        <input type="text" class="form-control text-center input-sm" value="<?php echo $rwdiferencia['sede'] ?>" readonly>
                        <input id="franquicia" name="franquicia" type="text" class="form-control text-center input-sm" value="<?php echo $franquicia ?>" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha Conciliar</span>
                        <input type="date" class="form-control"  name="fecha" id="fecha" required>
                    </div>
                </div>
            </div>
            <div class="row student text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SECCIONES" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SUMA DIFERENCIA" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SUMA RETEFUENTE" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SUMA RETEIVA" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SUMA RETEICA" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="SUMA COMISION" readonly>
                    </div>
                </div>
            </div>
            <div class="row student text-center">
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="DATO REGISTRADO" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="VALOR DOMICILIO" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="NUEVO VALOR" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="VALOR BANCO" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="DIFERENCIA" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bddif" name="bddif" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['diferencia']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domdif" name="domdif" class="form-control text-center input-sm" value="<?php echo round($rwdomicilio['diferencia']) ?>" placeholder="Valor Domicilio" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newdif" name="newdif" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bandif" name="bandif" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dif" name="dif" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdrte" name="bdrte" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['retefuente']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domrte" name="domrte" class="form-control text-center input-sm" value="<?php echo round($rwdomicilio['retefuente']) ?>" placeholder="Valor Domicilio" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newrte" name="newrte" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banrte" name="banrte" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrte" name="difrte" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdiva" name="bdiva" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteiva']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domiva" name="domiva" class="form-control text-center input-sm" value="<?php echo round($rwdomicilio['reteiva']) ?>" placeholder="Valor Domicilio" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newiva" name="newiva" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="baniva" name="baniva" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difiva" name="difiva" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdica" name="bdica" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteica']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domica" name="domica" class="form-control text-center input-sm" value="<?php echo round($rwdomicilio['reteica']) ?>" placeholder="Valor Domicilio" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newica" name="newica" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banica" name="banica" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difica" name="difica" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdcom" name="bdcom" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['comision']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domcom" name="domcom" class="form-control text-center input-sm" value="<?php echo round($rwdomicilio['comision']) ?>" placeholder="Valor Domicilio" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newcom" name="newcom" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="bancom" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difcom" name="difcom" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                    </div>
                </div>
            </div>
            <div class="row student text-center">
                <div class="col-6 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center input-sm" value="RESULTADO DIFERENCIA" readonly>
                    </div>
                </div>
                <div class="col-6 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="resdif" name="resdif" class="form-control text-center input-sm" placeholder="Total Diferencia" readonly>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="col-6">
            <div >
                <button type="button" onclick="calcular()" class="btn btn-primary">Calcular</button>
            </div>
        </div>
        <div class="col-6">
            <div >
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</form>
<?php } else {
?>
<?php } ?>

<!-- fin de la tabla -->
