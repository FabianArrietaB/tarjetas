$(document).ready(function(){
    $('#tblobservaciones').load('cartera/tblobservaciones.php');
});

$(document).ready(function(){
    setInterval(
        function(){
            const filtro = $('#filtro').val()
            $('#observaciones').load('cartera/tblobservaciones.php?filtro='+filtro);
        },1000
    );
});