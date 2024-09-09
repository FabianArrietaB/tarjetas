const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;
    return [year, month, day].join('-');
}

$('#num_pedido').keypress(function(e) {
    if(e.which == 13) {
        var pedido = $('#num_pedido').val();
        if(pedido === ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar una pedido',
                showConfirmButton: false,
                timer: 1500
            });
        }
        console.log(pedido)
        $.ajax({
            url : "../controller/cartera/pedidos.php",
            data : "pedido=" + pedido,
            type : 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                let tbl = '';
                data.forEach((item, index) => {
                    if(item.prerem == '' && item.numrem == ''){
                        remision = 'No se genero';
                    }else{
                        remision = item.prerem + ' - ' + item.numrem;
                    }
                    if(item.prefac == '' && item.numfac == ''){
                        factura = 'No se genero';
                    }else{
                        factura = item.prefac + ' - ' + item.numfac;
                    }
                    if(item.pedido == ''){
                        tbl += '<tr><td colspan="4">No hay datos</td></tr>';
                    }else{
                        tbl += `
                        <tr class="bg-white border-b">
                            <td style="width: 5%" class="text-center">${item.pedido}</td>
                            <td class="text-center" style="width: 15%" >${remision}</td>
                            <td class="text-center" style="width: 15%" >${factura}</td>
                            <td class="text-center" style="width: 15%" >${formatterPeso.format(Number(item.valor))}</td>
                            <td class="text-center" style="width: 10%" >${formatDate(item.fecped)}</td>
                            <td class="text-center" style="width: 20%" >${item.client}</td>
                            <td class="text-center" style="width: 10%" >${item.operad}</td>
                            <td class="text-center" style="width: 10%" >${item.usuari}</td>
                            <td class="text-center" style="width: 25%" >${item.fecaut}</td>
                        </tr>
                    `
                    }
                });
                document.getElementById('tblautorizaciones').innerHTML = tbl
            }
        });
    }
});