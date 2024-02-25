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


    }
?>