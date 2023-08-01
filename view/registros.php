<!-- Vista Admin y Supervisor -->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['rol'] == 4){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectarbd();
    $sql="SELECT
    p.id_porcentaje as idporcentaje,
    p.por_tipo as tiptar
    FROM porcentajes as p";
    $respuesta = mysqli_query($conexion, $sql);
?>
<!-- inicio del contenido principal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header text-center">
                    <div class="title">
                        <h2>AGREGAR REGISTRO</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" onclick="addregistro()">
                        <div class="row text-center">
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Ticket</label>
                                    <input type="email" class="form-control" id="ticket" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tipo Tarjeta</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Seleccione</option>
                                        <?php
                                            while($tiptar = mysqli_fetch_array($respuesta)) {
                                        ?>
                                                <option value="<?php echo $tiptar['idporcentaje']?>"><?php echo $tiptar['tiptar'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Valor</label>
                                    <input type="email" class="form-control" id="valor" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Iva</label>
                                    <input type="email" class="form-control" id="iva" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Neto</label>
                                    <input type="email" class="form-control" id="neto" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-1">
                                <div >
                                    <button class="btn btn-success" type="button">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete Fuente</label>
                                    <input type="email" class="form-control" id="retfue" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete IVA</label>
                                    <input type="email" class="form-control" id="retiva" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete ICA</label>
                                    <input type="email" class="form-control" id="retica" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Comision</label>
                                    <input type="email" class="form-control" id="comisi" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Banco</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Diferencia</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="000000">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header text-center">
                    <div class="title">
                        <h2>LISTA REGISTROS</h2>
                    </div>
                    <form method="GET">
                        <input class="form-control me-3" type="search" placeholder="Buscar" id="filtro" name="filtro">
                    </form>
                </div>
                <div class="card-body">
                    <div id="tablaregistros"></div>
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
<?php
}
?>