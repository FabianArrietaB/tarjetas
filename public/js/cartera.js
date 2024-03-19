let modal = $('#modalfacturas');
let modaldetalles = $('#modalobservaciones');

const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})

function tblclientes(){
    $.ajax({
        url : "../controller/cartera/clientes.php",
        type : 'GET',
        dataType: 'json',
        success: function (data) {
            let tbl = '';
            let total = 0;
            let totalinactivos = 0;
            data.forEach((item) => {
            if(item.activo === '0'){
                total += Number(item.total);
            }else{
                totalinactivos += Number(item.total);
            }
                if(item.activo === '0'){
                    tbl += `
                        <tr ondblclick="clientes('${item.docume}')" class="bg-white border-b">
                            <td class="text-center">${item.vendedor}</td>
                            <td class="text-center ${(item.total < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.total))}</td>
                        </tr>
                    `
                }
            });
            tbl += `
                        <tr ondblclick="clientes('1'))" class="bg-white border-b">
                            <td class="text-center">INATIVOS</td>
                            <td class="text-center ${(totalinactivos < 0) ? 'text-danger':''}">${formatterPeso.format(Number(totalinactivos))}</td>
                        </tr>
                    `
            tbl += `
                <tr class="table-secondary">
                    <th colspan="1">TOTAL</th>
                    <th colspan="1" class="text-right">${formatterPeso.format(Number(total + totalinactivos))}</th>
                </tr>
            `
            document.getElementById(`tblvendedores`).innerHTML = tbl
        }
    });
    //console.log(fecha)
}

function clientes(docume){
    $.ajax({
        url : "../controller/cartera/clientesporvendedor.php",
        data: "docume="+ docume,
        type : 'GET',
        dataType: 'json',
        success: function (data) {
            let tbl = '';
            let total = 0;
            data.forEach((item) => {
            total += Number(item.saldo);
            tbl += `
                <tr ondblclick="facturas('${item.nit}', '${item.cliente}')" class="bg-white border-b">
                    <td class="text-center">${item.nit} - ${item.cliente}</td>
                    <td class="text-center">${item.vendedor}</td>
                    <td class="text-center ${(item.por_vencer < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.por_vencer))}</td>
                    <td class="text-center ${(item.dias_1_a_30 < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.dias_1_a_30))}</td>
                    <td class="text-center ${(item.dias_31_a_60 < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.dias_31_a_60))}</td>
                    <td class="text-center ${(item.dias_61_a_90 < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.dias_61_a_90))}</td>
                    <td class="text-center ${(item.dias_mayor_90 < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.dias_mayor_90))}</td>
                    <td class="text-center ${(item.saldo < 0) ? 'text-danger':''}">${formatterPeso.format(Number(item.saldo))}</td>
                </tr>
            `
            });
            tbl += `
                <tr class="table-secondary">
                    <th colspan="7">TOTAL</th>
                    <td class="text-center ${(total < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(total))}</td>
                </tr>
            `
            document.getElementById(`tblclientes`).innerHTML = tbl
        }
    });
    //console.log(fecha)
}

function facturas(nit, cliente){
    $.ajax({
        url : "../controller/cartera/facturas.php",
        data: "nit="+ nit,
        type : 'GET',
        dataType: 'json',
        success: function (data) {
            let tbl = '';
            let totalvalor = 0;
            let totalabono = 0;
            let totalsaldo = 0;
            data.forEach((item) => {
            totalvalor += Number(item.valor);
            totalabono += Number(item.abono);
            totalsaldo += Number(item.saldo);
            direcc =  item.direccion;
            telefono = item.telefono;
            email = item.correo;
            tbl += `
                <tr class="bg-white border-b">
                    <td class="text-center">${item.factura}</td>
                    <td class="text-center">${item.fecha}</td>
                    <td class="text-center">${item.documento}</td>
                    <td class="text-center">${item.vendedor}</td>
                    <td class="text-center ${(item.valor < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(item.valor))}</td>
                    <td class="text-center ${(item.abono < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(item.abono))}</td>
                    <td class="text-center ${(item.saldo < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(item.saldo))}</td>
                </tr>
            `
            });
            tbl += `
                <tr class="table-secondary">
                    <th colspan="4">TOTAL</th>
                    <td class="text-center ${(totalvalor < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(totalvalor))}</td>
                    <td class="text-center ${(totalabono < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(totalabono))}</td>
                    <td class="text-center ${(totalsaldo < 0) ? 'text-danger':''}">${ formatterPeso.format(Number(totalsaldo))}</td>
                </tr>
            `
            var title = `
                <h5 class="modal-title" role="title" id="exampleModalLabel">Documentos de ${cliente}</h5>
            `
            var bodi = `
                <div class="row">
                    <div class="col-4 text-left">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="inputGroup-sizing-default"><strong>Dirección</strong></span>
                            <input disable value="${direcc}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="inputGroup-sizing-default"><strong>Correo</strong></span>
                            <input disable value="${email}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="inputGroup-sizing-default"><strong>Telefono</strong></span>
                            <input disable value="${telefono}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col-1 text-right">
                        <div class="d-grid gap-2">
                            <button onClick="observacion('${nit}', '${cliente}')" class="btn btn-outline-warning btn-sm" type="button"><i class="fa-solid fa-circle-info"></i></button>
                        </div>
                    </div>
                </div>
            `
            document.getElementById(`tblfacturas`).innerHTML = tbl
            document.getElementById(`title`).innerHTML = title
            document.getElementById(`body`).innerHTML = bodi
            modal.modal('show')
        }
    });
    //console.log(fecha)
}

function observacion(nit, cliente){
    var input = `<form id="frmaddobservacion" method="post" onsubmit="return addobservacion()">
                    <div class="row">
                        <div class="col-10 text-left">
                            <input hidden id="nit" name="nit" value="${nit}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            <input hidden id="nombre" name="nombre" value="${cliente}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Observacion</strong></span>
                                <input id="detalle" name="detalle" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class=  "fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                `

    document.getElementById(`observacion`).innerHTML = input
}

function addobservacion(){
    $.ajax({
        type: "POST",
        data: $('#frmaddobservacion').serialize(),
        url: "../controller/cartera/addobservacion.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if(respuesta == 1){
                //console.log(respuesta);
                $('#observacion').empty();
                toastr.success('Observacion Agregada!', 'Agregada')
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



function clear(){
    $('#observacion').empty();
    $('#frmaddobservacion')[0].reset();
}

window.onload=function(){
    tblclientes();
}
