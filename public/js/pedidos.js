const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
})

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
                            <td style="width: 10%" class="text-center">${++index}</td>
                            <td style="width: 10%" class="text-center">${item.pedido}</td>
                            <td class="text-center" style="width: 10%" >${remision}</td>
                            <td class="text-center" style="width: 10%" >${factura}</td>
                            <td class="text-center" style="width: 10%" >${formatterPeso.format(Number(item.valor))}</td>
                            <td class="text-center" style="width: 10%" >${item.client}</td>
                            <td class="text-center" style="width: 10%" >${item.vende}</td>
                            <td class="text-center" style="width: 10%" >${item.usuari}</td>
                        </tr>
                    `
                    }
                });
                document.getElementById('tblautorizaciones').innerHTML = tbl
            }
        });
    }
});