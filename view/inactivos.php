<!-- Vista Admin y Supervisro -->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['tarrol'] == 4){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
        <div class="page-content">
            <div class="card border-primary">
                <div class="card-header bg-success text-center text-white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4>DOCUMENTOS INACTIVOS</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                            <a class="acard" type="button" id="registros">
                                <div class="card border-danger text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <i class="fa-solid fa-list-ol fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-sm-right">Registros</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                            <a class="acard" type="button" id="conciliacion">
                                <div class="card border-danger text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <i class="fa-solid fa-list-check fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-sm-right">Conciliaciones</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row student text-center" style="align-items: center">
                        <div id="registrosinactivos"></div>
                        <div id="conciliacioninactivos"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin del contenido principal -->
<!-- por ultimo se carga el footer -->
<?php
require('footer.php');
?>
<!-- carga ficheros javascript -->
<script src="../public/js/bitacora.js"></script>

<?php
    }else{
        header("location:../index.php");
    }
?>