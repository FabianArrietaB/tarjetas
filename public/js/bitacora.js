$(document).ready(function(){
    $('#tablaprocesos').load('tablas/listaprocesos.php');
});

$(document).ready(function(){
    $('#registros').click(function(){
        ocultarsecciones();
        $('#registrosinactivos').load('tablas/listareginactivos.php');
        $('#registrosinactivos').show();
    });

    $('#conciliacion').click(function(){
        ocultarsecciones();
        $('#conciliacioninactivos').load('tablas/listaconinactivos.php');
        $('#conciliacioninactivos').show();
    });
})

function ocultarsecciones(){
    $('#registrosinactivos').hide();
    $('#conciliacioninactivos').hide();
    return false;
}

function actrivarregistro(idregistro, estado){
    $.ajax({
        type:"POST",
        data:"idregistro=" + idregistro +"&estado=" + estado,
        url:"../controller/registros/activarregistro.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#registrosinactivos').load('tablas/listareginactivos.php');
                Swal.fire({
                    icon: 'success',
                    title: 'Operacion Exitosa',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo realizar la operacion!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    });
}

function activarconciliacion(idconciliacion, estado){
    $.ajax({
        type:"POST",
        data:"idconciliacion=" + idconciliacion +"&estado=" + estado,
        url:"../controller/registros/activarconciliacion.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta)
                $('#conciliacioninactivos').load('tablas/listaconinactivos.php');
                Swal.fire({
                    icon: 'success',
                    title: 'Operacion Exitosa',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo realizar la operacion!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    });
}