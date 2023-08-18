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

function infvalores(){
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
    var sede = $('#sede').val();
    var master = ($('#master').is(":checked")) ? $('#master').val() : '';
    var visa = ($('#visa').is(":checked")) ? $('#visa').val() : '';
    var davi = ($('#davi').is(":checked")) ? $('#davi').val() : '';
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliaciongeneral').load('tablas/conciliaciongeneral.php?desde='+desde+'&hasta='+hasta+'&sede='+sede+'&master='+master+'&visa='+visa+'&davi='+davi);
    })
    //console.log(desde)
    //console.log(hasta)
    //console.log(sede)
}

function infmes(){
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
    var sede = $('#sede').val();
    var master = ($('#master').is(":checked")) ? $('#master').val() : '';
    var visa = ($('#visa').is(":checked")) ? $('#visa').val() : '';
    var davi = ($('#davi').is(":checked")) ? $('#davi').val() : '';
    $.ajax({
        method: 'GET',
    }).done(function(info) {
        $('#tablaconciliacionmes').load('tablas/conciliacionmes.php?desde='+desde+'&hasta='+hasta+'&sede='+sede+'&master='+master+'&visa='+visa+'&davi='+davi);
    
    })
    // console.log(desde)
    // console.log(hasta)
    // console.log(sede)
    //console.log(master)
    //console.log(visa)
    //console.log(davi)
}

function detalleconciliacion(idconciliacion){
    $.ajax({
        type: "POST",
        data: "idconciliacion=" + idconciliacion,
        url: "../controller/registros/detalleconciliacion.php",
        success: function(respuesta){
            respuesta = jQuery.parseJSON(respuesta);
            //console.log(respuesta)
            $('#idconciliacion').val(respuesta['idconciliacion']);
            $('#idoperador').val(respuesta['idoperador']);
            $('#idsede').val(respuesta['idsede']);
            $('#updsede').val(respuesta['sede']);
            $('#updfranquicia').val(respuesta['franquicia']);
            $('#updnewdif').val(respuesta['difnew']);
            $('#updbandif').val(respuesta['difban']);
            $('#updnewrte').val(respuesta['rtftnew']);
            $('#updbanrte').val(respuesta['rtftban']);
            $('#updnewiva').val(respuesta['rtivanew']);
            $('#updbaniva').val(respuesta['rtivaban']);
            $('#updnewica').val(respuesta['rticanew']);
            $('#updbanica').val(respuesta['rticaban']);
            $('#updnewcom').val(respuesta['connew']);
            $('#updbancom').val(respuesta['conban']);
            $('#diferenciau').val(respuesta['fecha']);
        }
    });
}

function editarconcilacion(){
    $.ajax({
        type: "POST",
        data: $('#updfrmeditdiferencia').serialize(),
        url: "../controller/registros/editarconciliacion.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                $('#editconciliacion').modal('hide');
                $('#tablalistaconciliaciones').load('tablas/listaconciliacion.php');
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

//CALCULAR DIFERENCIAS VS BANCOS
function uptcalcular() {
    var updnewdif = parseInt(document.getElementById("updnewdif").value);
    var updbandif = parseInt(document.getElementById("updbandif").value);
    var updnewrte = parseInt(document.getElementById("updnewrte").value);
    var updbanrte = parseInt(document.getElementById("updbanrte").value);
    var updnewiva = parseInt(document.getElementById("updnewiva").value);
    var updbaniva = parseInt(document.getElementById("updbaniva").value);
    var updnewica = parseInt(document.getElementById("updnewica").value);
    var updbanica = parseInt(document.getElementById("updbanica").value);
    var updnewcom = parseInt(document.getElementById("updnewcom").value);
    var updbancom = parseInt(document.getElementById("updbancom").value);
    if(updnewdif!=0 || updbandif!=0 || updnewrte!=0 || updbanrte!=0 || updnewiva!=0 || updbaniva!=0 || updnewica!=0 || updbanica!=0 || updnewcom!=0 || updbancom!=0){
        var upddif = updnewdif - updbandif;
        var upddifrte = updnewrte - updbanrte;
        var upddifiva = updnewiva - updbaniva;
        var upddifica = updnewica - updbanica;
        var upddifcom = updnewcom - updbancom;
        var updresdif = upddif - upddifrte + upddifiva + upddifica + upddifcom
        document.getElementById("upddif").value = upddif;
        document.getElementById("upddifrte").value = upddifrte;
        document.getElementById("upddifiva").value = upddifiva;
        document.getElementById("upddifica").value = upddifica;
        document.getElementById("upddifcom").value = upddifcom;
        document.getElementById("updresdif").value = updresdif;

        if (updresdif < 0 ){
            $("#updresdif").css("background","red")
         } else if (updresdif >0) {
            $("#updresdif").css("background","yellow")
         } else {
            $("#updresdif").css("background","green")
         }
    }
}