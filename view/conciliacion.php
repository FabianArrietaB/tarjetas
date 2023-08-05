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
                        <h2>RESUMEN CONCILIACION</h2>
                    </div>
                    <div class="col-3">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                            <select name="dategen" id="dategen" class="form-control input-sm" require>
                                <option value="">Seleccione Fecha</option>
								<?php
                                    $sql_registros = "SELECT DISTINCT c.aud_fecope as fecha FROM conciliacion AS c ORDER BY fecha DESC";
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
                            <span class="input-group-text" id="inputGroup-sizing-default">MES</span>
                            <select name="dategen" id="dategen" class="form-control input-sm" require>
                                <option value="">Seleccione Mes</option>
								<?php
                                    $sql_registros = "SELECT DISTINCT CASE MONTH(c.aud_fecope)
                                    WHEN 1 THEN 'ENERO'
                                    WHEN 2 THEN 'FEBRERO'
                                    WHEN 3 THEN 'MARZO'
                                    WHEN 4 THEN 'ABRIL'
                                    WHEN 5 THEN 'MAYO'
                                    WHEN 6 THEN 'JUNIO'
                                    WHEN 7 THEN 'JULIO'
                                    WHEN 8 THEN 'AGOSTO'
                                    WHEN 9 THEN 'SEPTIEMBRE'
                                    WHEN 10 THEN 'OCTUBRE'
                                    WHEN 11 THEN 'NOVIEMBRE'
                                    WHEN 12 THEN 'DICIEMBRE'
                                    END mes FROM conciliacion AS c ORDER BY mes ASC";
                                    $resultados = mysqli_query($conexion,$sql_registros);
									while($mes = mysqli_fetch_array($resultados)) {
								?>
									<option value="<?php echo $mes['mes']?>"><?php echo $mes['mes'];?></option>
								<?php }?>
							</select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Operador</span>
                            <select name="sede" id="sede" class="form-control input-sm" require>
                                <option value="">Seleccione Sede</option>
                                <option value="1">METROPOLIS</option>
                                <option value="2">FERRECASAS</option>
                                <option value="4">MAYORISTA</option>
							</select>
                        </div>
                    </div>
                    <div class="col-3 aling-items-center">
                        <div class="input-group input-group-sm">
                            <div class="d-grid gap-1 d-md-block">
                                <button class="btn btn-info" type="button" value="Reporte Valores Mes"      onclick="infvalores()"><i class="fa-solid fa-clipboard-list"></i></button>
                                <button class="btn btn-warning" type="button" value="Reporte Detallado Mes" onclick="infdetalle()"><i class="fa-solid fa-clipboard-list"></i></button>
                                <button class="btn btn-success" type="button" value="Reporte Detallado Mes" onclick="infmes()"><i class="fa-solid fa-clipboard-list"></i></button>
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
<script src="../public/js/conciliacion.js"></script>

<?php }else{
        header("../index.php");
    }
?>