<!-- Formulario (Editar) -->
<form id="frmeliminarconcili" method="post" onsubmit="return eliminarconcili()">
    <div class="modal fade" id="elicon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario (Registro) -->
                    <fieldset class="group-border">
                        <legend class="group-border"></legend>
                        <div class="row text-center">
                            <input hidden type="text" class="form-control" name="idconciliacion" id="idconciliacion" placeholder="">
                            <input hidden type="text" class="form-control" name="eliestadocon" id="eliestadocon" placeholder="">
                            <input hidden type="text" class="form-control" name="eliidsedecom" id="eliidsedecom" placeholder="">
                            <input hidden type="text" class="form-control" name="elifranquiciacom" id="elifranquiciacom" placeholder="">
                            <input hidden type="text" class="form-control" name="elifechacom" id="elifechacom" placeholder="">
                            <div class="col">
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="detallecon" id="detallecom" placeholder="Ingrese el Motivo">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="card-footer text-center">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Fin Formulario (Editar) -->
