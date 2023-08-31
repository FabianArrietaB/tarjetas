<!-- Vista Admin y Supervisro -->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['rol'] == 4){
    include "../model/conexion.php";
    $idusuario = $_SESSION['usuario']['id'];
    $con = new Conexion();
    $conexion = $con->conectar();
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="page-content">
        <div class="card border-primary">
            <div class="row">
                <div class="col-12">
                    <div class="card-header text-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="title">
                                    <h2>EVENTOS DEL SISTEMA</h2>
                                </div>
                            </div>
                        </div>
                        <form method="get">
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Año</span>
                                        <select name="year" id="year" onchange="obteneraño()" class="form-control input-sm">
                                            <option value="">Seleccione un Año</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Usuario</span>
                                        <select name="operador" id="operador" onchange="onteneroperador()" class="form-control input-sm">
                                            <option value="">Seleccione un  Usuario</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Modulo</span>
                                        <select name="modulo" id="modulo" onchange="obtnermodulo()" class="form-control input-sm">
                                            <option value="">Seleccione un Modulo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div id="tablaprocesos"></div>
                    </div>
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
<script src="../public/js/bitacora.js"></script>
<?php
}
?>