<!-- Vista Admin-->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['tarrol'] == 4 ||
    $_SESSION['usuario']['tarrol'] == 2 ||
    $_SESSION['usuario']['tarrol'] == 1){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $sql ="SELECT DISTINCT
    r.reg_fecope as fecha
    FROM registros as r
    ORDER BY fecha DESC";
    $respuesta = mysqli_query($conexion, $sql);
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="page-content">
        <div class="card border-primary">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-10">
                        <div class="title">
                            <h2>RESUMEN CAJA</h2>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                            <select name="date" id="date" onchange="obtenerfecha()" class="form-control input-sm">
                            <option value="<?php echo $hoy = date("Y-m-d")?>;" selected>Seleccione</option>
								<?php
									while($fecha = mysqli_fetch_array($respuesta)) {
								?>
									<option value="<?php echo $fecha['fecha']?>"><?php echo $fecha['fecha'];?></option>
								<?php }?>
							</select>
                        </div>
                    </div>
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