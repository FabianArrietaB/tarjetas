<!-- Vista Admin-->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    include "permisos.php"){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $sqldate ="SELECT DISTINCT
    r.reg_fecope as fecha
    FROM registros as r
    ORDER BY fecha DESC";
    $rwdate = mysqli_query($conexion, $sqldate);
    $sqluser ="SELECT DISTINCT
    r.id_operador as idoperador,
    u.user_nombre as operador
    FROM registros as r
    INNER JOIN usuarios as u ON u.id_usuario = r.id_operador
    ORDER BY operador DESC";
    $rwuser = mysqli_query($conexion, $sqluser);
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="page-content">
        <div class="card border-primary">
            <div class="card-header text-center">
                <div class="row">
                <?php if($_SESSION['usuario']['tarrol'] == 1) {?>
                    <div class="col-xs-12 col-sm-6 col-md-10">
                        <div class="title">
                            <h2>RESUMEN CAJA</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                            <select name="date" id="date" onchange="obtenerfecha()" class="form-control input-sm">
                            <option value="<?php echo $hoy = date("Y-m-d")?>;" selected>Seleccione</option>
								<?php
									while($fecha = mysqli_fetch_array($rwdate)) {
								?>
									<option value="<?php echo $fecha['fecha']?>"><?php echo $fecha['fecha'];?></option>
								<?php }?>
							</select>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <div class="title">
                            <h2>RESUMEN CAJA</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Mes</span>
                            <select name="idmes" id="idmes" class="form-control input-sm" require>
                                <option value="">Seleccione Mes</option>
                                <option value="1">ENERO</option>
                                <option value="2">FEBRERO</option>
                                <option value="3">MARZO</option>
                                <option value="4">ABRIL</option>
                                <option value="5">MAYO</option>
                                <option value="6">JUNIO</option>
                                <option value="7">JULIO</option>
                                <option value="8">AGOSTO</option>
                                <option value="9">SEPTIEMBRE</option>
                                <option value="10">OCTUBRE</option>
                                <option value="11">NOVIEMBRE</option>
                                <option value="12">DICIEMBRE</option>
							</select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Usuario</span>
                            <select name="user" id="user" class="form-control input-sm">
                            <option value="" selected>Seleccione</option>
                                <?php
                                    while($usuario = mysqli_fetch_array($rwuser)) {
                                ?>
                                    <option value="<?php echo $usuario['idoperador']?>"><?php echo $usuario['operador'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                            <select name="regfecha" id="regfecha" class="form-control input-sm" require>
                                <option value="">Seleccione Fecha</option>
							</select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1 aling-items-center">
                        <div class="input-group input-group-sm">
                            <div class="d-grid gap-1 d-md-block">
                                <button class="btn btn-info" type="button" value="Buscar" onclick="obtenerregistros()"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                <?php }?>
                </div>
            </div>
            <div class="card-body">
                <div class="row student text-center" style="align-items: center">
                    <div id="tablaresumen"></div>
                </div>
            </div>
        </div>
        <div class="card border-primary">
            <div class="card-header text-center">
                <div class="title">
                    <h2>INFORMACION GENERAL</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row student text-center" style="align-items: center">
                    <div id="tablaporcentajes"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin del contenido principal -->
<!-- por ultimo se carga el footer -->
<?php
    include "footer.php";
?>
<!-- carga ficheros javascript -->
<script src="../public/js/inicio.js"></script>

<?php }else{
        header("../index.php");
    }
?>