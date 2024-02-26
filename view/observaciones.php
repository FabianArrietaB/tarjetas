<!-- Vista Admin-->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['tarrol'] == 4 ||
    $_SESSION['usuario']['tarrol'] == 5){
    include "../model/conexion.php";
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="page-content">
        <div class="card border-primary">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="title">
                            <h2>OBSERVACIONES DE CLIENTES</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row student text-center" style="align-items: center">
                            <H3>DATOS CLIENTE</H3>
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Documento:</span>
                                    <input id="obsnit" name="obsnit" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Nombre:</span>
                                    <input id="obsnombre" name="obsnombre" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row student text-center" style="align-items: center">
                            <H3>LISTA OBSERVACIONES</H3>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped font-small">
                                    <thead>
                                        <tr>
                                            <th scope="col" >Fecha</th>
                                            <th scope="col" >Obsrevacion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblobservaciones">
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<script src="../public/js/cartera.js"></script>

<?php }else{
        header("../index.php");
    }
?>