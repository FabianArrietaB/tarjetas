<!-- Vista Admin-->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['rol'] == 4 ||
    $_SESSION['usuario']['rol'] == 2){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="page-content">
        <div class="card border-primary">
            <div class="card-header text-center">
                <div class="row">
                    <div class="title">
                        <h2>RESUMEN DIFERENCIA BANCO</h2>
                    </div>
                    <div class="col-4">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                            <select name="dategen" id="dategen" class="form-control input-sm" require>
                                <option value="">Seleccione Fecha</option>
								<?php
                                    $sql_registros = "SELECT DISTINCT r.reg_fecope as fecha FROM registros AS r ORDER BY fecha DESC";
                                    $resultados = mysqli_query($conexion,$sql_registros);
									while($fecha = mysqli_fetch_array($resultados)) {
								?>
									<option value="<?php echo $fecha['fecha']?>"><?php echo $fecha['fecha'];?></option>
								<?php }?>
							</select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Operador</span>
                            <select name="sede" id="sede" class="form-control input-sm" require>
                                <option value="">Seleccione Sede</option>
                                <option value="2">FERRECASAS</option>
                                <option value="3">METROPOLIS</option>
                                <option value="4">MAYORISTA</option>
							</select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Franquicia</span>
                            <select name="franquicia" id="franquicia" class="form-control input-sm" require>
                                <option value="">Seleccione Franquicia</option>
								<?php
                                    $sql_registros = "SELECT DISTINCT r.reg_tiptar as tipo FROM registros AS r";
                                    $resultados = mysqli_query($conexion,$sql_registros);
									while($fecha = mysqli_fetch_array($resultados)) {
								?>
									<option value="<?php echo $fecha['tipo']?>"><?php echo $fecha['tipo'];?></option>
								<?php }?>
							</select>
                        </div>
                    </div>
                    <div class="col-1 aling-items-center">
                        <div class="input-group input-group-sm">
                            <div class="d-grid gap-1 d-md-block">
                                <button class="btn btn-info" type="button" value="Buscar" onclick="infgeneral()"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row student text-center" style="align-items: center">
                    <div id="tablaregistrosgeneral"></div>
                    <div id="tablageneral"></div>
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