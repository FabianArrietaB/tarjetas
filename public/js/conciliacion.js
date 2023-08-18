$(document).ready(function(){
    $('#contotal').click(function(){
        ocultarsecciondes();
        $('#tablaconciliaciongeneral').load('tablas/conciliaciongeneral.php');
        $('#tablaconciliaciongeneral').show();
    });

    $('#condia').click(function(){
        ocultarsecciondes();
        $('#tablaconciliaciondia').load('tablas/conciliaciondia.php');
        $('#tablaconciliaciondia').show();
    });

    $('#conmes').click(function(){
        ocultarsecciondes();
        $('#tablaconciliacionmes').load('tablas/conciliacionmes.php');
        $('#tablaconciliacionmes').show();
    });

    $('#listcon').click(function(){
        ocultarsecciondes();
        $('#tablalistaconciliaciones').load('tablas/listaconciliacion.php');
        $('#tablalistaconciliaciones').show();
    });
});

function ocultarsecciondes(){
    $('#tablaconciliaciondia').hide();
    $('#tablaconciliacionmes').hide();
    $('#tablaconciliaciongeneral').hide();
    $('#tablalistaconciliaciones').hide();
    return false;
}

//CONCILIACION
function infvalores(){
    var mes = $('#mes').val();
    var sede = $('#sede').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliaciongeneral').load('tablas/conciliaciongeneral.php?mes='+mes+'&sede='+sede);
    })
    //console.log(mes)
    //console.log(sede)
}

function infdetalle(){
    var fecha = $('#fecha').val();
    var sede = $('#sede').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliaciondia').load('tablas/conciliaciondia.php?fecha='+fecha+'&sede='+sede);
    })
    //console.log(fecha)
    //console.log(sede)
}

function infmes(){
    var mes = $('#mes').val();
    var sede = $('#sede').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliacionmes').load('tablas/conciliacionmes.php?mes='+mes+'&sede='+sede);
    })
    //console.log(mes)
    //console.log(sede)
}

function detalleconciliacion(idconciliacion){
    $.ajax({
        type: "POST",
        data: "idconciliacion=" + idconciliacion,
        url: "../controller/registros/detalleconciliacion.php",
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