$(document).ready(function(){
    $('#tablaporcentajes').load('tablas/porcentajes.php');
});

$(document).ready(function(){
    $('#tablaregistros').load('tablas/registros.php');
});

function addregistro(){
    $.ajax({
        type: "POST",
        data: $('#frmaddregistro').serialize(),
        url: "../controller/registros/agregar.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#tablaregistros').load('tablas/registros.php');
                $('#frmaddregistro')[0].reset();
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