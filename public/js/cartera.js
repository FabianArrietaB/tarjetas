let modal = $('#modalfacturas');

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
                <tr ondblclick="facturas('${item.nit}')" class="bg-white border-b">
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
                    <th colspan="1" class="text-right">${formatterPeso.format(Number(total))}</th>
                </tr>
            `
            document.getElementById(`tblclientes`).innerHTML = tbl
        }
    });
    //console.log(fecha)
}

function facturas(nit){
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
                    <th colspan="1" class="text-right">${totalvalor}</th>
                    <th colspan="1" class="text-right">${totalabono}</th>
                    <th colspan="1" class="text-right">${totalsaldo}</th>
                </tr>
            `
            document.getElementById(`tblfacturas`).innerHTML = tbl
            modal.modal('show')
        }
    });
    //console.log(fecha)
}

window.onload=function(){
    tblclientes();
}
