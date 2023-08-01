<?php
    include "conexion.php";

    class Registros extends Conexion {

        public function addregistro($datos){
            $conexion = Conexion::conectarbd();
            $sql = "INSERT INTO registros (id_operador, reg_numticket, reg_tipcuenta, reg_tiptar, reg_valor, reg_iva, reg_rtefte, reg_rteiva, reg_rteica, reg_comision, reg_tardesc, reg_banco, reg_diferencia, reg_fecope) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $descuento = $datos['retfue'] + $datos['retiva'] + $datos['retica'] + $datos['comisi'];
            $query->bind_param("isissssssssssss", $datos['idoperador'], $datos['ticket'], $datos['idtiptar'], $datos['tiptar'], $datos['valor'], $datos['iva'], $datos['retfue'], $datos['retiva'], $datos['retica'], $datos['comisi'], $descuento, $datos['banco'], $datos['diferencia'], $fecha);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function detallePorcentaje($idtiptar){
            $conexion = Conexion::conectarbd();
            $sql ="SELECT
            p.id_porcentaje  as idporcentaje,
            p.por_tipo       as tipo,
            (p.por_mes * 100) as mes,
            p.por_tipR       as tipr
            FROM porcentajes as p
            WHERE p.id_porcentaje = '$idtiptar'";
        $respuesta = mysqli_query($conexion,$sql);
        $alumno = mysqli_fetch_array($respuesta);
        $datos = array(
            'idporcentaje' => $alumno['idporcentaje'],
            'tipo' => $alumno['tipo'],
            'mes' => number_format($alumno['mes'], 2),
            'tipr' => $alumno['tipr'],
        );
        return $datos;
        }
    }
?>