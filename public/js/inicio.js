$(document).ready(function(){
    $('#tablaporcentajes').load('tablas/porcentajes.php');
});

$(document).ready(function(){
    $('#tablaregistros').load('tablas/registros.php');
});

$(document).ready(function(){
    $('#tablaresumen').load('tablas/resumen.php');
});

$(document).ready(function(){
    $('#tablageneral').load('tablas/general.php');
});

$(document).ready(function(){
    $('#tablaregistrosgeneral').load('tablas/tablageneral.php');
});

function addregistro(){
    $.ajax({
        type: "POST",
        data: $('#frmaddregistro').serialize(),
        url: "../controller/registros/agregar.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                console.log(respuesta);
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

function detalleregistro(idregistro){
    $.ajax({
        type: "POST",
        data: "idregistro=" + idregistro,
        url: "../controller/registros/detalleregistro.php",
        success: function(respuesta){
            respuesta = jQuery.parseJSON(respuesta);
            //console.log(respuesta)
            $('#idregistro').val(respuesta['idregistro']);
            $('#tiptaru').val(respuesta['tiptar']);
            $('#idtiptaru').val(respuesta['idtipcuenta']);
            $('#portaru').val(respuesta['portar']);
            $('#ticketu').val(respuesta['ticket']);
            $('#valoru').val(respuesta['valor']);
            $('#ivau').val(respuesta['iva']);
            $('#netou').val(respuesta['neto']);
            $('#retfueu').val(respuesta['retfte']);
            $('#retivau').val(respuesta['rteiva']);
            $('#reticau').val(respuesta['rteica']);
            $('#comisiu').val(respuesta['comision']);
            $('#bancou').val(respuesta['banco']);
            $('#diferenciau').val(respuesta['difer']);
        }
    });
}

function editarregistro(){
    $.ajax({
        type: "POST",
        data: $('#frmeditarregistro').serialize(),
        url: "../controller/registros/editar.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                $('#editar').modal('hide');
                $('#tablaregistros').load('tablas/registros.php');
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Actualizado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al Editar!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}
//CONSULTAR DATOS PORCENTAJE INGRESOR
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

//CONSULTAR DATOS PORCENTAJE UPDATE
$('#frmeditarregistro').change(function(){
    //condicion para limpiar campos
    if($('#idtiptaru').val()==0){
        $('#portaru').val("");
        $('#tiptaru').val("");
        return
    }
    $.ajax({
        type:"POST",
        data:"idtiptaru=" + $('#idtiptaru').val(),
        url:"../controller/registros/porcentaje.php",
        success:function(respuesta){
            respuesta=jQuery.parseJSON(respuesta);
            $('#portaru').val(respuesta['mes']);
            $('#tiptaru').val(respuesta['tipr']);
        }
    });
});

//CALCULAR VALORES INSERTAR
jQuery('#valor, #iva, #portar').on('change',function(){
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

//CALCULAR VALORES UPDATE
jQuery('#valoru , #ivau , #portaru').on('change',function(){
    //Obtengo el valor
    var valoru = $('#valoru').val();
    //Obtengo iva
    var ivau = $('#ivau').val();
    //Obtengo %tarjeta
    var portaru = $('#portaru').val();
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
    var netou = valoru - ivau;
    var retfueu = netou * 0.015;
    var retivau = ivau * 0.15;
    var reticau = netou * 0.005;
    var comisionu = netou * portaru / 100;
    var bancou = valoru - comisionu;
    var descuentou = retfueu + retivau + reticau + comisionu;
    var diferenciau = valoru - descuentou;
    //Lo muestro en el div neto
    $('#netou').val(netou);
    $('#retfueu').val(retfueu);
    $('#retivau').val(retivau);
    $('#reticau').val(reticau);
    $('#comisiu').val(comisionu);
    $('#bancou').val(bancou);
    $('#diferenciau').val(diferenciau);
});

//CONSULTA USUARIO
function obtenerfecha(){
    var fecha = $('#date').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaresumen').load('tablas/resumen.php?date='+fecha);
    })
}

//CONSULTA ADMINISTRADOR Y SUPERVISOR
//RESUMEN CAJA
function generar(){
    var date = $('#date').val();
    var idoperador = $('#idoperador').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablageneral').load('tablas/general.php?date='+date+'&idoperador='+idoperador);
    })
    //console.log(date)
    //console.log(idoperador)
}
//RESUMEN DIFERENCIA
function infgeneral(){
    var dategen = $('#dategen').val();
    var sede = $('#sede').val();
    var franquicia = $('#franquicia').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaregistrosgeneral').load('tablas/tablageneral.php?dategen='+dategen+'&sede='+sede+'&franquicia='+franquicia);
    })
    //console.log(dategen)
    //console.log(sede)
    console.log(franquicia)
}

//CALCULAR DIFERENCIAS
// jQuery('#bandif , #banrte , #baniva , #banica , #bancom').on('change',function(){
//     //Obtengo el valor
//     var bddif = $('#bddif').val();
//     var bdrte = $('#bdrte').val();
//     var bdiva = $('#bdiva').val();
//     var bdica = $('#bdica').val();
//     var bdcom = $('#bdcom').val();
//     //Obtengo el valor
//     var bandif = $('#bandif').val();
//     var banrte = $('#banrte').val();
//     var baniva = $('#baniva').val();
//     var banica = $('#banica').val();
//     var bancom = $('#bancom').val();
//     //En caso de que alguno de los dos este en blanco, el neto estará en blanco.
//     if(bandif.length==0 || banrte.length==0 || baniva.length==0 || banica.length==0 || bancom.length==0){
//         $('#dif').val("");
//         $('#difrte').val("");
//         $('#difiva').val("");
//         $('#difica').val("");
//         $('#difcom').val("");
//         return;
//     }
//     //Realizo el cálculo
//     var dif = bddif - bandif;
//     var difrte = bdrte - banrte;
//     var difiva = bdiva - baniva;
//     var difica = bdica - banica;
//     var difcom = bdcom - bancom;
//     //Lo muestro en el div
//     $('#dif').val(dif);
//     $('#difrte').val(difrte);
//     $('#difiva').val(difiva);
//     $('#difica').val(difica);
//     $('#difcom').val(difcom);
// });



