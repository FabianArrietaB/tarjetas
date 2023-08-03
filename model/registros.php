<?php
    date_default_timezone_set('America/Bogota');
    include "conexion.php";

    class Registros extends Conexion {

        public function addregistro($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO registros (id_operador,
                                        reg_numticket,
                                        reg_tipcuenta,
                                        reg_tiptar,
                                        reg_valor,
                                        reg_iva,
                                        reg_rtefte,
                                        reg_rteiva,
                                        reg_rteica,
                                        reg_comision,
                                        reg_tardesc,
                                        reg_banco,
                                        reg_diferencia,
                                        reg_fecope) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $prefijo = $datos['pretik'] .' - '. $datos['ticket'];
            $descuento = $datos['retfue'] + $datos['retiva'] + $datos['retica'] + $datos['comisi'];
            $query->bind_param("isisssssssssss",
                                $datos['idoperador'],
                                $prefijo,
                                $datos['idtiptar'],
                                $datos['tiptar'],
                                $datos['valor'],
                                $datos['iva'],
                                $datos['retfue'],
                                $datos['retiva'],
                                $datos['retica'],
                                $datos['comisi'],
                                $descuento,
                                $datos['banco'],
                                $datos['diferencia'],
                                $fecha);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function detallePorcentaje($idtiptar){
            $conexion = Conexion::conectar();
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
            'mes' => number_format($alumno['mes'],2),
            'tipr' => $alumno['tipr'],
            );
            return $datos;
        }

        public function detalleregistro($idregistro){
            $conexion = Conexion::conectar();
            $sql ="SELECT
            r.id_registro     as idregistro,
            r.reg_numticket   as ticket,
            r.reg_tipcuenta   as idtipcuenta,
            r.reg_tiptar      as tiptar,
            r.reg_valor       as valor,
            r.reg_iva         as iva,
            r.reg_rtefte      as retfte,
            r.reg_rteiva      as rteiva,
            r.reg_rteica      as rteica,
            r.reg_comision    as comision,
            r.reg_tardesc     as descu,
            r.reg_banco       as banco,
            r.reg_diferencia  as difer,
            (p.por_mes * 100) as portar
            FROM registros    AS r
            INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
            WHERE r.id_registro = '$idregistro'";
            $respuesta = mysqli_query($conexion,$sql);
            $registro = mysqli_fetch_array($respuesta);
            $datos = array(
                'idregistro' => $registro['idregistro'],
                'ticket' => $registro['ticket'],
                'idtipcuenta' => $registro['idtipcuenta'],
                'tiptar' => $registro['tiptar'],
                'valor' => $registro['valor'],
                'iva' => $registro['iva'],
                'neto' => $registro['valor'] - $registro['iva'],
                'retfte' => $registro['retfte'],
                'rteiva' => $registro['rteiva'],
                'rteica' => $registro['rteica'],
                'comision' => $registro['comision'],
                'descu' => $registro['descu'],
                'portar' => number_format($registro['portar'],2),
                'banco' => $registro['banco'],
                'difer' => $registro['difer'],
            );
            return $datos;
        }

        public function editarregistro($datos){
            $conexion = Conexion::conectar();
            $sql = "UPDATE registros SET id_operador = ?,
                                        reg_numticket = ?,
                                        reg_tipcuenta = ?,
                                        reg_tiptar = ?,
                                        reg_valor = ?,
                                        reg_iva = ?,
                                        reg_rtefte = ?,
                                        reg_rteiva = ?,
                                        reg_rteica = ?,
                                        reg_comision = ?,
                                        reg_tardesc = ?,
                                        reg_banco = ?,
                                        reg_diferencia = ?
                                        WHERE id_registro = ?";
            $query = $conexion->prepare($sql);
            $descuento = $datos['retfue'] + $datos['retiva'] + $datos['retica'] + $datos['comisi'];
            $query->bind_param('issssssssssssi',
                                $datos['idoperador'],
                                $datos['ticket'],
                                $datos['idtiptar'],
                                $datos['tiptar'],
                                $datos['valor'],
                                $datos['iva'],
                                $datos['retfue'],
                                $datos['retiva'],
                                $datos['retica'],
                                $datos['comisi'],
                                $descuento,
                                $datos['banco'],
                                $datos['diferencia'],
                                $datos['idregistro']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function detallegeneral($dategen, $sede){
            $conexion = Conexion::conectar();
            $sql ="SELECT
            r.id_registro     as idregistro,
            r.id_sede         as idsede,
            r.reg_numticket   as ticket,
            r.reg_tipcuenta   as idtipcuenta,
            r.reg_tiptar      as tiptar,
            r.reg_valor       as valor,
            r.reg_iva         as iva,
            r.reg_rtefte      as retfte,
            r.reg_rteiva      as rteiva,
            r.reg_rteica      as rteica,
            r.reg_comision    as comision,
            r.reg_tardesc     as descu,
            r.reg_banco       as banco,
            r.reg_diferencia  as difer
            from registros as r
            WHERE r.id_sede = '$sede' AND r.reg_fecope = '$dategen'";
            $respuesta = mysqli_query($conexion,$sql);
            $registro = mysqli_fetch_array($respuesta);
            $datos = array(
                'idregistro' => $registro['idregistro'],
                'idsede' => $registro['idsede'],
                'ticket' => $registro['ticket'],
                'idtipcuenta' => $registro['idtipcuenta'],
                'tiptar' => $registro['tiptar'],
                'valor' => $registro['valor'],
                'iva' => $registro['iva'],
                'neto' => $registro['valor'] - $registro['iva'],
                'retfte' => $registro['retfte'],
                'rteiva' => $registro['rteiva'],
                'rteica' => $registro['rteica'],
                'comision' => $registro['comision'],
                'descu' => $registro['descu'],
                'banco' => $registro['banco'],
                'difer' => $registro['difer'],
            );
            return $datos;
        }
    }
?>