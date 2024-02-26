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
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <form action="" method="GET">
                            <input class="form-control me-xl-2" type="search" placeholder="Ingrese Documento o Nombre" name="filtro" id="filtro">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="tblobservaciones"></div>
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
<script src="../public/js/observaciones.js"></script>

<?php }else{
        header("../index.php");
    }
?>