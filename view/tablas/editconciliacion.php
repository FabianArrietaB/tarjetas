<form id="updfrmeditdiferencia" method="post" onsubmit="return editarconcilacion()">
    <div class="modal fade" id="editconciliacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updexampleModalLabel">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="group-border">
                        <legend class="group-border text-center"><b>CONCILIACION</b> </legend>
                        <div class="row student text-center">
                            <input hidden type="text" class="form-control" name="idconciliacion" id="idconciliacion" placeholder="">
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SECCIONES" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SUMA DIFERENCIA" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SUMA RETEFUENTE" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SUMA RETEIVA" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SUMA RETEICA" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="SUMA COMISION" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row student text-center">
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="NUEVO VALOR" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="VALOR BANCO" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="DIFERENCIA" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updnewdif" name="updnewdif" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="updbandif" name="updbandif" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="upddif" name="upddif" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updnewrte" name="updnewrte" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="updbanrte" name="updbanrte" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="upddifrte" name="upddifrte" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updnewiva" name="updnewiva" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="updbaniva" name="updbaniva" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="upddifiva" name="upddifiva" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updnewica" name="updnewica" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="updbanica" name="updbanica" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="upddifica" name="upddifica" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updnewcom" name="updnewcom" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="updbancom" name="updbancom" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="upddifcom" name="upddifcom" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row student text-center">
                            <div class="col-6 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="RESULTADO DIFERENCIA" readonly>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="updresdif" name="updresdif" class="form-control text-center input-sm" placeholder="Total Diferencia" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="card-footer text-center">
                        <button type="button" onclick="uptcalcular()" class="btn btn-primary">Calcular</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>