<!-- Vista Admin y Supervisro -->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['tarrol'] == 4){
    include "../model/conexion.php";
    $idusuario = $_SESSION['usuario']['tarid'];
    $con = new Conexion();
    $conexion = $con->conectar();
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
        <div class="page-content">
            <div class="card border-primary">
                <div class="card-header bg-success text-center text-white">
                    <div class="row">
                        <div class="col-12">
                            <h4>PERMISOS Y PARAMETROS</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <a class="acard" type="button" id="btnpredat">
                                <div class="card border-danger text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <i class="fa-solid fa-envelope fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-sm-right">DATAFONOS Y PREFIJOS</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a class="acard" type="button" id="btnpreuser">
                                <div class="card border-danger text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <i class="fa-solid fa-folder fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-sm-right">ASIGNACION PREFIJOS</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a class="acard" type="button" id="btndatuser">
                                <div class="card border-danger text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <i class="fa-solid fa-lock fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-sm-right">ASIGNACION DATAFONOS</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div id="tblpredat"></div>
                        <div id="tblpreuser"></div>
                        <div id="tbldatuser"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin del contenido principal -->
<!-- por ultimo se carga el footer -->
<?php
    include '../view/config/adddatafo.php';
    include '../view/config/addprefijo.php';
    include 'footer.php';
?>
<!-- carga ficheros javascript -->
<script src="../public/js/config.js"></script>

<?php
    }else{
        header("location:../index.php");
    }
?>