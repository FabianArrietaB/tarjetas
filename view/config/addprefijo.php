<form id="frmaddprefijo" method="post" onsubmit="return addprefijo()">
    <div class="modal fade" id="addprefijo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Prefijo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario (Usuario) -->
                <!-- Formulario (Usuario) -->
                <fieldset class="group-border">
                    <div class="row">
                        <legend></legend>
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Prefijo</span>
                                <input type="text" id="prefijo" name="prefijo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Sede</span>
                                <select id="preidsede" name="preidsede" class="form-select" aria-label="Default select example" required>
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
                    <button class="btn btn-success" data-bs-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>