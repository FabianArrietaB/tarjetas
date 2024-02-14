function tblclientes(){
    nombre = $("#nombre").val();
    $.ajax({
        url : "../controller/cartera/clietnes.php",
        type : 'GET',
        dataType: 'json',
        success: function (data) {
            let tbl = '';
            data.forEach((item) => {
            tbl += `
                <tr class="bg-white border-b">
                    <td class="py-3 px-6 text-center">${item.prefij} - ${item.consec}</td>
                    <td class="py-3 px-6 text-center">${item.items}</td>
                    <td class="py-3 px-6 text-center">${item.obser} - ${item.evento}</td>
                    <td class="text-right">$ ${item.valor}</td>
                    <td class="py-3 px-6 text-center">${item.fecha}</td>
                </tr>
            `
            });
            document.getElementById(`tblfacturas`).innerHTML = tbl
        }
    });
    //console.log(fecha)
}