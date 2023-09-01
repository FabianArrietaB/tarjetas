<?php
    date_default_timezone_set('America/Bogota');
    include "conexion.php";

    class Registros extends Conexion {

        public function addregistro($datos){
            $conexion = Conexion::conectar();
            $prefijo = $datos['pretik'] .' - '. $datos['ticket'];
            $sql = "INSERT INTO registros (
                id_sede,
                id_operador,
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
                reg_fecope) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $descuento = $datos['retfue'] + $datos['retiva'] + $datos['retica'] + $datos['comisi'];
            $query->bind_param("iisisssssssssss",
                    $datos['idsede'],
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
            r.reg_estado      as estado,
            r.reg_diferencia  as difer,
            (p.por_mes * 100) as portar
            FROM registros    AS r
            INNER JOIN porcentajes AS p ON p.id_porcentaje = r.reg_tipcuenta
            WHERE r.id_registro = '$idregistro'";
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
                'portar' => number_format($registro['portar'],2),
                'banco' => $registro['banco'],
                'estado' => $registro['estado'],
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

        public function adddiferencia($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO conciliacion (id_operador,
                                        id_sede,
                                        con_franquicia,
                                        con_difenuevo,
                                        con_difebanco,
                                        con_rteftenew,
                                        con_rtefteban,
                                        con_rteivanew,
                                        con_rteivaban,
                                        con_rteicanew,
                                        con_rteicaban,
                                        con_comisinew,
                                        con_comisiban,
                                        con_fecconcil,
                                        con_fecope) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $query->bind_param("iisssssssssssss",
                                $datos['idoperador'],
                                $datos['sede'],
                                $datos['franquicia'],
                                $datos['newdif'],
                                $datos['bandif'],
                                $datos['newrte'],
                                $datos['banrte'],
                                $datos['newiva'],
                                $datos['baniva'],
                                $datos['newica'],
                                $datos['banica'],
                                $datos['newcom'],
                                $datos['bancom'],
                                $datos['fecha'],
                                $fecha);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function detalleconciliacion($idconciliacion){
            $conexion = Conexion::conectar();
            $sql ="SELECT
            c.id_conciliacion idconciliacion,
            c.id_operador idoperador,
            c.id_sede idsede,
            s.sed_nombre sede,
            c.con_franquicia franquicia,
            c.con_difenuevo difnew,
            c.con_difebanco difban,
            c.con_rteftenew rtftnew,
            c.con_rtefteban rtftban,
            c.con_rteivanew rtivanew,
            c.con_rteivaban rtivaban,
            c.con_rteicanew rticanew,
            c.con_rteicaban rticaban,
            c.con_comisinew connew,
            c.con_comisiban conban,
            c.con_estado    estado,
            c.con_fecconcil fecha
            FROM conciliacion AS c
            INNER JOIN sedes AS s ON s.id_sede = c.id_sede
            WHERE c.id_conciliacion = '$idconciliacion'";
            $respuesta = mysqli_query($conexion,$sql);
            $registro = mysqli_fetch_array($respuesta);
            $datos = array(
                'idconciliacion' => $registro['idconciliacion'],
                'idoperador' => $registro['idoperador'],
                'idsede' => $registro['idsede'],
                'sede' => $registro['sede'],
                'franquicia' => $registro['franquicia'],
                'difnew' => $registro['difnew'],
                'difban' => $registro['difban'],
                'rtftnew' => $registro['rtftnew'],
                'rtftban' => $registro['rtftban'],
                'rtivanew' => $registro['rtivanew'],
                'rtivaban' => $registro['rtivaban'],
                'rticanew' => $registro['rticanew'],
                'rticaban' => $registro['rticaban'],
                'connew' => $registro['connew'],
                'conban' => $registro['conban'],
                'estado' => $registro['estado'],
                'fecha' => $registro['fecha'],
            );
            return $datos;
        }

        public function editarconcilacion($datos){
            $conexion = Conexion::conectar();
            $sql = "UPDATE conciliacion SET id_operador = ?,
                                        con_difenuevo = ?,
                                        con_difebanco = ?,
                                        con_rteftenew = ?,
                                        con_rtefteban = ?,
                                        con_rteivanew = ?,
                                        con_rteivaban = ?,
                                        con_rteicanew = ?,
                                        con_rteicaban = ?,
                                        con_comisinew = ?,
                                        con_comisiban = ?,
                                        con_fecupt = ?
                                        WHERE id_conciliacion = ?";
            $query = $conexion->prepare($sql);
            $fecha = date("Y-m-d");
            $query->bind_param('isssssssssssi',
                                $datos['idoperador'],
                                $datos['updnewdif'],
                                $datos['updbandif'],
                                $datos['updnewrte'],
                                $datos['updbanrte'],
                                $datos['updnewiva'],
                                $datos['updbaniva'],
                                $datos['updnewica'],
                                $datos['updbanica'],
                                $datos['updnewcom'],
                                $datos['updbancom'],
                                $fecha,
                                $datos['idconciliacion']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function detallefecha($mes){
            $conexion = Conexion::conectar();
            $sql ="SELECT DISTINCT
                r.reg_fecope as fecha
                FROM registros AS r
                WHERE MONTH(r.reg_fecope) = '$mes'
                ORDER BY fecha DESC";
            $respuesta = mysqli_query($conexion,$sql);
            $null = "No Hay Fechas";
            if($respuesta >= 0){
                while($fecha = mysqli_fetch_array($respuesta)){
                    echo '<option value="'.$fecha['fecha'].'">'.$fecha['fecha'].'</option>';
                }
            }else{
                    echo '<option value="'.$null.'">'.$null.'</option>';
            }
        }

        public function ConsultaFactura($pretik, $ticket){
            $conexion = Conexion::conectar();
            $numtik = $pretik . ' - ' . $ticket;
            $sql = "SELECT * FROM registros r INNER JOIN usuarios u ON u.id_usuario = r.id_operador WHERE r.reg_numticket = '$numtik'";
            $respuesta = mysqli_query($conexion,$sql);
            if(mysqli_num_rows($respuesta) > 0){
                $datosFactura = mysqli_fetch_array($respuesta);
                if($datosFactura['reg_estado'] == 1){
                    $factura = $datosFactura['reg_numticket'];
                    $fecha = $datosFactura['reg_fecope'];
                    $usuario = $datosFactura['user_nombre'];
                    return 1;
                }else{
                    return 0;
                }
            } else {
                return 0;
            }
        }

        public function ConsultaDiferencia($franquicia, $fecha, $sede){
            $conexion = Conexion::conectar();
            $sql = "SELECT * FROM conciliacion c INNER JOIN usuarios u ON u.id_usuario = c.id_operador WHERE c.con_fecconcil = '$fecha' AND c.id_sede = '$sede' AND c.con_franquicia = '$franquicia'";
            $respuesta = mysqli_query($conexion,$sql);
            if(mysqli_num_rows($respuesta) > 0){
                $datosConciliacion = mysqli_fetch_array($respuesta);
                if($datosConciliacion['con_estado'] == 1){
                    $fechacon = $datosConciliacion['con_fecconcil'];
                    $usuario = $datosConciliacion['user_nombre'];
                    return 1;
                }else{
                    return 0;
                }
            } else {
                return 0;
            }
        }

        public function eliminarregistro($datos){
            $conexion = Conexion::conectar();
            $fecha = date("Y-m.d");
            if($datos['estado'] == 1){
                $estado = 0;
            }else{
                $estado = 1;
            }
            $modulo = 'EL REGISTRO';
            $sql = "UPDATE registros SET reg_estado = ? WHERE id_registro = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('ii', $estado, $datos['idregistro']);
            $respuesta = $query->execute();
            if($respuesta > 0){
                $historial = "INSERT INTO historial (id_operador, id_sede, his_numdoc, his_detall, his_modulo, his_fecope) VALUES (?, ?, ?, ?, ?, ?)";
                $query = $conexion->prepare($historial);
                $query->bind_param('isssss', $datos['idoperador'], $datos['idsede'], $datos['ticket'], $datos['detalle'], $modulo, $fecha);
                $respuesta = $query->execute();
            }
            return $respuesta;
        }

        public function eliminarconciliacion($datos){
            $conexion = Conexion::conectar();
            $fecha = date("Y-m.d");
            $modulo = 'EL CONCILIACION';
            if($datos['estado'] == 1){
                $estado = 0;
            }else{
                $estado = 1;
            }
            $modulo = 'EL REGISTRO';
            $sql = "UPDATE conciliacion SET con_estado = ? WHERE id_conciliacion = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('ii', $estado, $datos['idconciliacion']);
            $respuesta = $query->execute();
            if($respuesta > 0){
                $historial = "INSERT INTO historial (id_operador, id_sede, his_numdoc, his_detall, his_modulo, his_fecope) VALUES (?, ?, ?, ?, ?, ?)";
                $query = $conexion->prepare($historial);
                $ticket = str_pad($datos['idconciliacion'], 2, "0", STR_PAD_LEFT);
                $query->bind_param('isssss', $datos['idoperador'], $datos['idsede'], $ticket, $datos['detalle'], $modulo, $fecha);
                $respuesta = $query->execute();
            }
            return $respuesta;
        }
    }
?>