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
                    <div class="col-xs-12 col-sm-8 col-md-3">
                        <div class="title">
                            <h2>INFORMACION CLIENTES</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <form action="" method="GET">
                            <input class="form-control me-xl-2" type="search" placeholder="Ingrese Dato o Nombre a Buscar" name="filtro" id="filtro">
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="d-grid gap-2">
                            <a  href="observaciones.php" class="btn btn-outline-primary" type="button">Observaciones</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="row student text-center" style="align-items: center">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped font-small">
                                    <thead>
                                        <tr>
                                            <th scope="col" >Vendedor Fomplus</th>
                                            <th scope="col" >Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblvendedores">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-8">
                        <div class="row student text-center" style="align-items: center">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped font-small">
                                    <thead>
                                        <tr>
                                            <th scope="col" >Cliente</th>
                                            <th scope="col" >Vendedor Metroapp</th>
                                            <th scope="col" >Por Vencer</th>
                                            <th scope="col" >01 a 30</th>
                                            <th scope="col" >31 a 60</th>
                                            <th scope="col" >61 a 90</th>
                                            <th scope="col" >Mayor a 90</th>
                                            <th scope="col" >Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblclientes">
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
<!-- Modal -->
<div class="modal fade" id="modalfacturas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <div id="title"></div>
                <button onclick="clear()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="body"></div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <table class="table table-sm font-small">
                            <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th>Fecha</th>
                                    <th>Tipo Documento</th>
                                    <th>Vendendor</th>
                                    <th>Valor</th>
                                    <th>Abono</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody id="tblfacturas">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div id="observacion"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalobservaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <div id="title2"></div>
                <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-12">
                        <table class="table table-sm font-small">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Detalle</th>
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