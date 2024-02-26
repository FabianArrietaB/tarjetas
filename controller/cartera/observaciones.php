<?php
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $nit = strip_tags(trim($_GET['nit']));
    // Do Prepared Query
    $query = "SELECT * FROM cartera WHERE car_nitcli LIKE '%$nit%'";
    // Do a quick fetchall on the results
    $respuesta = mysqli_query($conexion, $query);
    $list = array();
    while ($list=mysqli_fetch_array($respuesta)){
        $data[] = array(
            'id' => $list['id_cartera'],
            'operador' => $list['id_operador'],
            'nit' => $list['car_nitcli'],
            'cliente' => $list['car_nombre'],
            'detalle' => $list['car_obser'],
            'fecha' => $list['car_fecope']
        );
    }
    echo json_encode($data);
    // return the result in json
    // include "../../model/cartera.php";
    // $nit = $_GET['nit'];
    // $Cartera = new Cartera();
    // echo json_encode($Cartera->observaciones($nit));
?>