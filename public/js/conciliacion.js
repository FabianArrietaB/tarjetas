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
});

function ocultarsecciondes(){
    $('#tablaconciliaciondia').hide();
    $('#tablaconciliacionmes').hide();
    return false;
}

//CONCILIACION
function infvalores(){
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