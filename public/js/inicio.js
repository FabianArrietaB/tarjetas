$(document).ready(function(){
    $('#tablaporcentajes').load('tablas/porcentajes.php');
});

$(document).ready(function(){
    $('#tablaregistros').load('tablas/registros.php');
});

$(document).ready(function(){
    $('#tablaresumen').load('tablas/resumen.php');
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

//CONSULTAR DATOS PORCENTAJE
$('#frmaddregistro').change(function(){
    //condicion para limpiar campos
    if($('#idtiptar').val()==0){
        $('#portar').val("");
        $('#tiptar').val("");
        return
    }
    $.ajax({
        type:"POST",
        data:"idtiptar=" + $('#idtiptar').val(),
        url:"../controller/registros/detalle.php",
        success:function(respuesta){
            respuesta=jQuery.parseJSON(respuesta);
            $('#portar').val(respuesta['mes']);
            $('#tiptar').val(respuesta['tipr']);
        }
    });
});

jQuery('#valor , #iva , #portar').on('change',function(){
    //Obtengo el valor
    var valor = $('#valor').val();
    //Obtengo iva
    var iva = $('#iva').val();
    //Obtengo %tarjeta
    var portar = $('#portar').val();
    //En caso de que alguno de los dos este en blanco, el neto estará en blanco.
    if(valor.length==0 || iva.length==0){
        $('#neto').val("");
        $('#retfue').val("");
        $('#retiva').val("");
        $('#retica').val("");
        $('#comisi').val("");
        $('#banco').val("");
        $('#diferencia').val("");
        return;
    }
    //Realizo el cálculo
    var neto = valor - iva;
    var retfue = neto * 0.015;
    var retiva = iva * 0.15;
    var retica = neto * 0.005;
    var comision = neto * portar / 100;
    var banco = valor - comision;
    var descuento = retfue + retiva + retica + comision;
    var diferencia = valor - descuento;
    //Lo muestro en el div neto
    $('#neto').val(neto);
    $('#retfue').val(retfue);
    $('#retiva').val(retiva);
    $('#retica').val(retica);
    $('#comisi').val(comision);
    $('#banco').val(banco);
    $('#diferencia').val(diferencia);
});