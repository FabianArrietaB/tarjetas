$(document).ready(function(){
    $('#tablaconciliacion').load('tablas/conciliacion.php');
});

//CONCILIACION
function generar(){
    var fecha = $('#fecha').val();
    var mes = $('#mes').val();
    var sede = $('#sede').val();
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliacion').load('tablas/conciliacion.php?fecha='+fecha+'&mes='+mes+'&sede='+sede);
    })
    //console.log(date)
    //console.log(idoperador)
}