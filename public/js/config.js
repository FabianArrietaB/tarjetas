$(document).ready(function(){
    $('#btnpredat').click(function(){
        ocultar();
        $('#tblpredat').load('config/tbldatpre.php');
        $('#tblpredat').show();
    });

    $('#btnpreuser').click(function(){
        ocultar();
        $('#tblpreuser').load('config/tblpreuser.php');
        $('#tblpreuser').show();
    });

    $('#btndatuser').click(function(){
        ocultar();
        $('#tbldatuser').load('config/tbldatuser.php');
        $('#tbldatuser').show();
    });

});

function ocultar(){
    $('#tblpredat').hide();
    $('#tblpreuser').hide();
    $('#tbldatuser').hide();
    return false;
}

function adddatuser(){
    $.ajax({
        type: "POST",
        data: $('#frmadddatuser').serialize(),
        url: "../controller/config/adddatuser.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#tbldatuser').load('config/tbldatuser.php');
                $('#frmadddatuser')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Agregado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}

function eliminardatuser(id){
    $.ajax({
        type: "POST",
        data:"id=" + id,
        url:"../controller/config/eliminardatuser.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#tbldatuser').load('config/tbldatuser.php');
                    swal.fire({
                        icon: 'success',
                        title: 'Relacion Eliminada Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }else{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al Eliminar!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
}

function addpreuser(){
    $.ajax({
        type: "POST",
        data: $('#frmaddpreuser').serialize(),
        url: "../controller/config/addpreuser.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#tblpreuser').load('config/tblpreuser.php');
                $('#frmaddpreuser')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Agregado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}

function eliminarpreuser(id){
    $.ajax({
        type: "POST",
        data:"id=" + id,
        url:"../controller/config/eliminarpreuser.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#tblpreuser').load('config/tblpreuser.php');
                    swal.fire({
                        icon: 'success',
                        title: 'Relacion Eliminada Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }else{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al Eliminar!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
}

function adddatafono(){
    $.ajax({
        type: "POST",
        data: $('#frmadddatafono').serialize(),
        url: "../controller/config/adddatafono.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#tblpredat').load('config/tbldatpre.php');
                $('#frmadddatafono')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Datafono Agregado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}

function eliminardatafono(iddatafono){
    $.ajax({
        type: "POST",
        data:"iddatafono=" + iddatafono,
        url:"../controller/config/eliminardatafono.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#tblpredat').load('config/tbldatpre.php');
                    swal.fire({
                        icon: 'success',
                        title: 'Datafono Eliminado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }else{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al Eliminar!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
}

function addprefijo(){
    $.ajax({
        type: "POST",
        data: $('#frmaddprefijo').serialize(),
        url: "../controller/config/addprefijo.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#tblpredat').load('config/tbldatpre.php');
                $('#frmaddprefijo')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Prefijo Agregado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}

function eliminarprefijo(idprefijo){
    $.ajax({
        type: "POST",
        data:"idprefijo=" + idprefijo,
        url:"../controller/config/eliminarprefijo.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#tblpredat').load('config/tbldatpre.php');
                    swal.fire({
                        icon: 'success',
                        title: 'Prefijo Eliminado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }else{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al Eliminar!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
}