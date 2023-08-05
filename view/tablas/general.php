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
<?php if($sede != "") { ?>
<form id="frmadddiferencia" method="post" onsubmit="return adddiferencia()">
    <div  class="row text-center">
        <fieldset class="group-border mb-3">
            <div class="row mb-3">
                <div class="col-8">
                    <legend  class="group-border">DIFERENCIA <?php echo $rwdiferencia['tiptar'] ?> </legend>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Fecha Registro</label>
                        <input type="date" class="form-control"  name="fecha" id="fecha" required>
                    </div>
                </div>
            </div>
            <div class="row text-center">
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
                        <input type="text" id="domdif" name="domdif" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
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
                        <input type="text" id="banrte" name="banrte" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="domrte" name="domrte" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="newrte" name="newrte" class="form-control text-center input-sm" placeholder="Nuevo Valor" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difrte" name="difrte" class="form-control text-center input-sm" placeholder="Diferencia" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdiva" name="bdiva" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteiva']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="baniva" name="baniva" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="domiva" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dif" name="newiva" class="form-control text-center input-sm" placeholder="Nuevo Valor" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difiva" name="difiva" class="form-control text-center input-sm" placeholder="Diferencia" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdica" name="bdica" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteica']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="banica" name="banica" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="domica" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dif" name="newica" class="form-control text-center input-sm" placeholder="Nuevo Valor" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difica" name="difica" class="form-control text-center input-sm" placeholder="Diferencia" >
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div class="input-group mb-3">
                        <input type="text" id="bdcom" name="bdcom" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['comision']) ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="bancom" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="bancom" name="domcom" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="dif" name="newcom" class="form-control text-center input-sm" placeholder="Nuevo Valor" >
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="difcom" name="difcom" class="form-control text-center input-sm" placeholder="Diferencia" >
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
<?php } else {
?>
<?php } ?>

<!-- fin de la tabla -->
