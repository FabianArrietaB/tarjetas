<?php
    date_default_timezone_set('America/Bogota');
    include "conexion.php";

    class Cartera extends Conexion {

        public function addobservacion($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO cartera (
                id_operador,
                car_nitcli,
                car_nombre,
                car_obser
                ) VALUES( ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $query->bind_param("isss",
                    $datos['idoperador'],
                    $datos['nit'],
                    $datos['nombre'],
                    $datos['detalle'],
                    );
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function observaciones($nit){
            $conexion = Conexion::conectar();
            $sql ="SELECT
                c.id_cartera  idcartera,
                c.id_operador idoperador,
                c.car_nitcli  nit,
                c.car_nombre  cliente,
                c.car_obser   detalle,
                c.car_fecope   fecha
            FROM cartera as c
            WHERE c.car_nitcli = '$nit'";
            $respuesta = mysqli_query($conexion,$sql);
            if(mysqli_num_rows($respuesta) > 0){
                $detalle = mysqli_fetch_array($respuesta);
                $datos = array(
                    'idcartera' => $detalle['idcartera'],
                    'idoperador' => $detalle['idoperador'],
                    'nit' => $detalle['nit'],
                    'cliente' => $detalle['cliente'],
                    'detalle' => $detalle['detalle'],
                    'fecha' => $detalle['fecha']
                );
                return $datos;
            }else{
                return 0;
            }
        }
    }
?>