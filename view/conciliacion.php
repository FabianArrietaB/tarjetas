<!-- Vista Admin-->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['tarrol'] == 4 ||
    $_SESSION['usuario']['tarrol'] == 2){
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
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-2 mb-2">
                            <div class="input-group ">
                                <span class="input-group-text" id="inputGroup-sizing-default">Desde</span>
                                <input type="date" class="form-control" id="desde" name="desde" tabindex="2" maxlength="10" size="20">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-2 mb-2">
                            <div class="input-group ">
                                <span class="input-group-text" id="inputGroup-sizing-default">Hasta</span>
                                <input type="date" class="form-control" id="hasta" name="hasta" tabindex="2" maxlength="10" size="20">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-2 mb-2">
                            <div class="input-group ">
                                <span class="input-group-text" id="inputGroup-sizing-default">SEDE</span>
                                <select name="sede" id="sede" class="form-control input-sm" require>
                                    <option value="">Seleccione Sede</option>
                                    <option value="3">METROPOLIS</option>
                                    <option value="4">MAYORISTA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-2">
                            <div class="input-group input-group-sm">
                                <div class="col-xs-4">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineCheckbox1">Mastercard</label>
                                        <input id="master" name="master" class="form-check-input" type="checkbox" value="MASTERCARD">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineCheckbox1">Visa</label>
                                        <input id="visa" name="visa" class="form-check-input" type="checkbox" value="VISA">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineCheckbox1">Davivienda</label>
                                        <input id="davi" name="davi" class="form-check-input" type="checkbox" value="DAVIVIENDA">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-2">
                            <div class="input-group input-group-sm">
                                    <!-- <input value="DIA" id="condia" class="btn btn-warning" type="button" onclick="infdetalle()"> -->
                                    <div class="col-xs-4">
                                        <button value="MES" id="conmes" class="btn btn-success mr-2" type="button" onclick="infmes()">MES</button>
                                    </div>
                                    <div class="col-xs-4">
                                        <button value="GENERAL" id="contotal" class="btn btn-info" type="button"  onclick="infvalores()">GENERAL</button>
                                    </div>
                                    <div class="col-xs-4">
                                        <button value="LISTA" id="listcon" class="btn btn-primary" type="button" onclick="lista()">LISTA</button>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row student text-center" style="align-items: center">
                    <div id="tablaconciliaciongeneral"></div>
                    <div id="tablaconciliaciondia"></div>
                    <div id="tablaconciliacionmes"></div>
                    <div id="tablalistaconciliaciones"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin del contenido principal -->
<!-- por ultimo se carga el footer -->
<?php
    include "tablas/detaelicon.php";
    include "tablas/editconciliacion.php";
    include "footer.php";

?>
<!-- carga ficheros javascript -->
<script src="../public/js/conciliacion.js"></script>

<?php }else{
        header("../index.php");
    }
?>