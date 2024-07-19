<!-- Formulario (Editar) -->
<form id="frmeditarregistro" method="post" onsubmit="return editarregistro()">
    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario (Registro) -->
                    <fieldset class="group-border">
                        <legend class="group-border">Informacion Registro</legend>
                        <div class="row text-center">
                            <input hidden type="text" class="form-control" name="idregistro" id="idregistro" placeholder="">
                            <input hidden type="text" class="form-control" name="tiptaru" id="tiptaru" placeholder="">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tipo Tarjeta</label>
                                    <select id="idtiptaru" name="idtiptaru" class="form-select" aria-label="Default select example">
                                        <option selected>Seleccione</option>
                                        <?php
                                            $sql="SELECT p.id_porcentaje as idporcentaje, p.por_mes as mes, p.por_tipo as tiptar FROM porcentajes as p";
                                            $respuesta = mysqli_query($conexion, $sql);
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
                                    <input type="text" class="form-control"  name="portaru" id="portaru" placeholder="000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Ticket</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="prefijou" id="prefijou" placeholder="000000" required>
                                        <input type="text" class="form-control" name="ticketu" id="ticketu" placeholder="000000" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Valor</label>
                                    <input type="text" class="form-control" name="valoru" id="valoru" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Iva</label>
                                    <input type="text" class="form-control" name="ivau" id="ivau" placeholder="000000">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Neto</label>
                                    <input type="text" class="form-control" name="netou" id="netou" placeholder="000000" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete Fuente</label>
                                    <input type="text" class="form-control" name="retfueu" id="retfueu" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Comision</label>
                                    <input type="text" class="form-control" name="comisiu" id="comisiu" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete IVA</label>
                                    <input type="text" class="form-control" name="retivau" id="retivau" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Rete ICA</label>
                                    <input type="text" class="form-control" name="reticau" id="reticau" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Banco</label>
                                    <input type="text" class="form-control" name="bancou" id="bancou" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Diferencia</label>
                                    <input type="text" class="form-control" name="diferenciau" id="diferenciau" placeholder="000000" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Fecha Registro</label>
                                    <input type="date" class="form-control"  name="fechau" id="fechau" required>
                                </div>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </fieldset>
                    <div class="card-footer text-center">
                        <button class="btn btn-success" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</form>
<!-- Fin Formulario (Editar) -->
