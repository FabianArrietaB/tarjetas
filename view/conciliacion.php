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
                        <!-- <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
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
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-2">
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="master" name="master" value="MASTERCARD"/>
                                    <label class="btn btn-outline-warning check-label" for="master">MASTERCARD</label>
                                    <input type="checkbox" class="btn-check" id="visa" name="visa" value="VISA"/>
                                    <label class="btn btn-outline-primary check-label" for="visa">VISA</label>
                                    <input type="checkbox" class="btn-check" id="davi" name="davi" value="DAVIVIENDA"/>
                                    <label class="btn btn-outline-danger check-label" for="davi">DAVIVIENDA</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-2">
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-success" value="MES" id="conmes" onclick="infmes()">MES</button>
                                    <button type="button" class="btn btn-outline-info" value="GENERAL" id="contotal" onclick="infvalores()">GENERAL</button>
                                    <button type="button" class="btn btn-outline-primary" value="LISTA" id="listcon" onclick="lista()">LISTA</button>
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