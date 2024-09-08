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
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="title">
                            <h2>INFORMACION PEDIDO AUTORIZADO</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <input type="text" id="num_pedido" name="num_pedido" class="form-control" placeholder="Escriba Numero Pedido" aria-describedby="button-addon2">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <div class="row student text-center" style="align-items: center">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped font-small">
                                    <thead>
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >PEDIDO</th>
                                            <th scope="col" >REMISIONES</th>
                                            <th scope="col" >FACTURA</th>
                                            <th scope="col" >MONTO</th>
                                            <th scope="col" >CLIENTE</th>
                                            <th scope="col" >VENDEDOR</th>
                                            <th scope="col" >AUTORIZADO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblautorizaciones">
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
<script src="../public/js/pedidos.js"></script>

<?php }else{
        header("../index.php");
    }
?>