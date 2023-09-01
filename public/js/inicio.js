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

function validar(){
    $.ajax({
        url:"../controller/registros/consultaticket.php",
        type:"POST",
        data:$('#frmaddregistro').serialize(),
        success:function(respuesta){
            respuesta = respuesta.trim();
            console.log(respuesta)
            if(respuesta == 1){
                swal.fire({
                    icon: 'error',
                    title: 'Registro Ya existe',
                    text: 'Ya se encuentra un Registro con este ticket',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                addregistro();
            }
        }
    });
    return false;
}

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
            console.log(respuesta)
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
        $('#tablaregistrosgeneral').load('tablas/tablageneral.php?dategen='+dategen+'&sede='+sede);
        $('#tablageneral').load('tablas/general.php?dategen='+dategen+'&sede='+sede+'&franquicia='+franquicia);
    })
    //console.log(dategen)
    //console.log(sede)
    //console.log(franquicia)
}

//CALCULAR DIFERENCIAS VS BANCOS
function calcular() {
    var bddif = parseInt(document.getElementById("bddif").value);
    var domdif = parseInt(document.getElementById("domdif").value);
    var bandif = parseInt(document.getElementById("bandif").value);
    var bdrte = parseInt(document.getElementById("bdrte").value);
    var domrte = parseInt(document.getElementById("domrte").value);
    var banrte = parseInt(document.getElementById("banrte").value);
    var bdiva = parseInt(document.getElementById("bdiva").value);
    var domiva = parseInt(document.getElementById("domiva").value);
    var baniva = parseInt(document.getElementById("baniva").value);
    var bdica = parseInt(document.getElementById("bdica").value);
    var domica = parseInt(document.getElementById("domica").value);
    var banica = parseInt(document.getElementById("banica").value);
    var bdcom = parseInt(document.getElementById("bdcom").value);
    var domcom = parseInt(document.getElementById("domcom").value);
    var bancom = parseInt(document.getElementById("bancom").value);
    if(bddif!=0 || domdif!=0 || bdrte!=0 || domrte!=0 || bdiva!=0 || domiva!=0 || bdica!=0 || domica!=0 || bdcom!=0 || domcom!=0){
        var newdif = bddif + domdif;
        var dif = newdif - bandif;
        var newrte = bdrte + domrte;
        var difrte = newrte - banrte;
        var newiva = bdiva + domiva;
        var difiva = newiva - baniva;
        var newica = bdica + domica;
        var difica = newica - banica;
        var newcom = bdcom + domcom;
        var difcom = newcom - bancom;
        var resdif = dif - difrte + difiva + difica + difcom
        document.getElementById("newdif").value = newdif;
        document.getElementById("dif").value = dif;
        document.getElementById("newrte").value = newrte;
        document.getElementById("difrte").value = difrte;
        document.getElementById("newiva").value = newiva;
        document.getElementById("difiva").value = difiva;
        document.getElementById("newica").value = newica;
        document.getElementById("difica").value = difica;
        document.getElementById("newcom").value = newcom;
        document.getElementById("difcom").value = difcom;
        document.getElementById("resdif").value = resdif;

        if (resdif < 0 ){
            $("#resdif").css("background","red")
         } else if (resdif >0) {
            $("#resdif").css("background","yellow")
         } else {
            $("#resdif").css("background","green")
         }
    }
}

function validardiferencia(){
    $.ajax({
        url:"../controller/registros/consultadiferencia.php",
        type:"POST",
        data:$('#frmadddiferencia').serialize(),
        success:function(respuesta){
            respuesta = respuesta.trim();
            console.log(respuesta)
            if(respuesta == 1){
                swal.fire({
                    icon: 'error',
                    title: 'Registro ya existe',
                    text: 'Ya se encuentra un Registro para esta Fecha, Sede y Franquicia',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                adddiferencia();
            }
        }
    });
    return false;
}

//INSERTAR CONCILIACION
function adddiferencia(){
    $.ajax({
        type: "POST",
        data: $('#frmadddiferencia').serialize(),
        url: "../controller/registros/agregarconciliacion.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                console.log(respuesta);
                $('#tablaregistros').load('tablas/registros.php');
                $('#frmadddiferencia')[0].reset();
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

//CARGAR MESES
jQuery('#mes').on('change', function(){
    var mes = $('#mes').val();
    cargarfechas();
    //console.log(mes)
})

//Función para cargar las provincias al campo "select".
function cargarfechas(){
    var fecha = $('#dategen');
    $.ajax({
        type: "GET",
        url: "../controller/registros/detallefecha.php",
        data: "mes=" + $('#mes').val(),
        success:function(data){
            fecha.html(data);
        }
    });
    //console.log(fecha)
}

function detalleeliminacionregistro(idregistro){
    $.ajax({
        type: "POST",
        data: "idregistro=" + idregistro,
        url: "../controller/registros/detelireg.php",
        success: function(respuesta){
            respuesta = jQuery.parseJSON(respuesta);
            console.log(respuesta)
            $('#idregistro').val(respuesta['idregistro']);
            $('#eliticket').val(respuesta['ticket']);
            $('#eliestado').val(respuesta['estado']);
            $('#eliidsede').val(respuesta['idsede']);
        }
    });
}

function eliminarregistro(){
    $.ajax({
        type: "POST",
        data: $('#frmeliminarregistro').serialize(),
        url:"../controller/registros/eliminarreg.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                console.log(respuesta);
                $('#tablaregistros').load('tablas/registros.php');
                $('#frmeliminarregistro')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Eliminado Exitosamente',
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

$(document).ready(function() {
    $('#developers').pageMe({
    pagerSelector: '#developer_page',
    showPrevNext: true,
    hidePageNumbers: false,
    perPage: 3
    });
    });


