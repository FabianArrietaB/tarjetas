<!-- Vista Admin y Supervisor -->
<?php
    include "header.php";
    include "navbar.php";
    if(isset($_SESSION['usuario']) &&
    $_SESSION['usuario']['rol'] == 4 ||
    $_SESSION['usuario']['rol'] == 1){
    include "../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $sql="SELECT
        p.id_porcentaje as idporcentaje,
        p.por_mes        as mes,
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
                <div class="card-body text-center">
                    <form id="frmaddregistro" method="post" onsubmit="return validar()">
                        <div class="row text-center">
                            <input hidden type="text" class="form-control" name="tiptar" id="tiptar" placeholder="">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tipo Tarjeta</label>
                                    <select id="idtiptar" name="idtiptar" class="form-select" aria-label="Default select example" required>
                                        <option selected>Seleccione</option>
                                        <?php
                                            while($tiptar = mysqli_fetch_array($respuesta)) {
                                        ?>
                                            <option value="<?php echo $tiptar['idporcentaje']?>"><?php echo $tiptar['idporcentaje']?> . <?php echo $tiptar['tiptar'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">%</label>
                                    <input type="text" class="form-control"  name="portar" id="portar" placeholder="000" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Ticket</label>
                                    <div class="input-group">
                                        <select id="pretik" name="pretik" class="form-select" aria-label="Default select example" required>
                                            <option value="CM01">CM01</option>
                                            <option value="CM02">CM02</option>
                                            <option value="CBM">CBM</option>
                                            <option value="CFC">CFC</option>
                                        </select>
                                        <input type="text" class="form-control" name="ticket" id="ticket" placeholder="000000" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Valor</label>
                                    <input type="text" class="form-control" name="valor" id="valor" placeholder="000000" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Iva</label>
                                    <input type="text" class="form-control" name="iva" id="iva" placeholder="000000" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Neto</label>
                                    <input type="text" class="form-control" name="neto" id="neto" placeholder="000000" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete Fuente</label>
                                    <input type="text" class="form-control" name="retfue" id="retfue" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Comision</label>
                                    <input type="text" class="form-control" name="comisi" id="comisi" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete IVA</label>
                                    <input type="text" class="form-control" name="retiva" id="retiva" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete ICA</label>
                                    <input type="text" class="form-control" name="retica" id="retica" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Banco</label>
                                    <input type="text" class="form-control" name="banco" id="banco" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Diferencia</label>
                                    <input type="text" class="form-control" name="diferencia" id="diferencia" placeholder="000000" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div >
                                    <button type="submit" class="btn btn-success" >Agregar</button>
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
    include "tablas/detaelireg.php";
    include "tablas/editar.php";
    include "footer.php";
?>
<!-- carga ficheros javascript -->
<script src="../public/js/inicio.js"></script>
<?php
}
?>