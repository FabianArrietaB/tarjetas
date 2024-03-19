<!-- Formulario (Editar) -->
<form id="frmadddatafono" method="post" onsubmit="return adddatafono()">
    <div class="modal fade" id="adddatafono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Datafono</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario (Usuario) -->
                    <fieldset class="group-border">
                    <div class="row">
                        <legend></legend>
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Datafono</span>
                                <input type="text" id="datafono" name="datafono" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Serial</span>
                                <input type="text" id="serial" name="serial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Sede</span>
                                <select id="idsede" name="idsede" class="form-select" aria-label="Default select example" required>
                                <option selected>Seleccione</option>
                                <?php
                                    $sql="SELECT s.id_sede as idsede, s.sed_nombre as sede FROM sedes as s WHERE s.sed_estado = 1";
                                    $respuesta = mysqli_query($conexion, $sql);
                                    while($sede = mysqli_fetch_array($respuesta)) {
                                    ?>
                                    <option value="<?php echo $sede['idsede']?>"><?php echo $sede['sede'];?></option>
                                <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    <div class="card-footer text-center">
                        <button class="btn btn-success" data-bs-dismiss="modal">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>