<form id="frmeditdiferencia" method="post" onsubmit="return editarconcilacion()">
    <div class="modal fade" id="editconciliacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="group-border">
                        <legend class="group-border text-center"><b>CONCILIACION</b> </legend>
                        <div class="row student text-center">
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
                                    <input type="text" class="form-control text-center input-sm" value="DATO REGISTRADO" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center input-sm" value="VALOR DOMICILIO" readonly>
                                </div>
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
                                    <input type="text" id="bddif" name="bddif" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['diferencia']) ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="domdif" name="domdif" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="newdif" name="newdif" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="bandif" name="bandif" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="dif" name="dif" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="bdrte" name="bdrte" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['retefuente']) ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="domrte" name="domrte" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="newrte" name="newrte" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="banrte" name="banrte" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="difrte" name="difrte" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="bdiva" name="bdiva" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteiva']) ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="domiva" name="domiva" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="newiva" name="newiva" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="baniva" name="baniva" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="difiva" name="difiva" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="bdica" name="bdica" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['reteica']) ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="domica" name="domica" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="newica" name="newica" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="banica" name="banica" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="difica" name="difica" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="input-group mb-3">
                                    <input type="text" id="bdcom" name="bdcom" class="form-control text-center input-sm" value="<?php echo round($rwdiferencia['comision']) ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="domcom" name="domcom" class="form-control text-center input-sm" placeholder="Valor Domicilio" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="newcom" name="newcom" class="form-control text-center input-sm" placeholder="Nuevo Valor" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="bancom" name="bancom" class="form-control text-center input-sm" placeholder="Valor Banco" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="difcom" name="difcom" class="form-control text-center input-sm" placeholder="Diferencia" readonly>
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
                                    <input type="text" id="resdif" name="resdif" class="form-control text-center input-sm" placeholder="Total Diferencia" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="card-footer text-center">
                        <button type="button" onclick="calcular()" class="btn btn-primary">Calcular</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>