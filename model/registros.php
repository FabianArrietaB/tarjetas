<?php
    include "conexion.php";

    class Registros extends Conexion {

        public function addregistro($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO registros (id_operador, reg_numticket, reg_tipcuenta, reg_valor, reg_iva, reg_tardesc, reg_diferencia, reg_fecope) VALUES( ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $query->bind_param("isisssss", $datos['idoperador'], $datos['ticket'], $datos['idtiptar'], $datos['valor'], $datos['iva'], $datos['comisi'], $datos['diferencia'], $fecha);
            $respuesta = $query->execute();
            return $respuesta;
        }
    }
?>