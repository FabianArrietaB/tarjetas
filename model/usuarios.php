<?php
    include "conexion.php";

    class Usuarios extends Conexion {

        public function ingresousuario($usuario, $password){
            $conexion = Conexion::conectar();
            $sql =  "SELECT * FROM usuarios WHERE user_nombre = '$usuario' AND user_password = '$password'";
            $respuesta = mysqli_query($conexion, $sql);
            if(mysqli_num_rows($respuesta) > 0){
                $datosUsuario = mysqli_fetch_array($respuesta);
                if($datosUsuario['user_estado'] == 1){
                    $_SESSION['usuario']['nombre'] = $datosUsuario['user_nombre'];
                    $_SESSION['usuario']['id'] = $datosUsuario['id_usuario'];
                    $_SESSION['usuario']['rol'] = $datosUsuario['id_rol'];
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }

        public function activarusuario($idusuario, $estado){
            $conexion = Conexion::conectar();
            //CONSULTA DETALLE DE LA USUARIO
            $estact = "SELECT u.user_nombre AS usuario FROM usuarios as u WHERE u.id_usuario = '$idusuario'";
            $resultado = mysqli_query($conexion, $estact);
            $respuesta = mysqli_fetch_array($resultado);
            //VALIDACION DEL ESTADO
            $usuario = $respuesta['usuario'];
            $hoy = date("Y-m-d");
            $registro = 'CAMBIO';
            $modulo = 'TAREAS';
            $idoperador = $_SESSION['usuario']['id'];
            if ($respuesta > 0) {
                if($estado == 1){
                    $estado = 0;
                    $nomest = 'INACTIVO';
                }else{
                    $estado = 1;
                    $nomest = 'ACTIVO';
                }
                //REGISTRO AUDITORIA
                $insertbitacora = "INSERT INTO bitacora (bit_tipeve, bit_fecope, bit_operador, bit_modulo, bit_detall) VALUES (?,?,?,?,?)";
                $query = $conexion->prepare($insertbitacora);
                $detalle = 'EL ESTADO DEL USUARIO ' . $usuario . ' A ' . $nomest;
                $query->bind_param("ssiss", $registro, $hoy, $idoperador, $modulo, $detalle);
                $respuesta = $query->execute();
                $sql = "UPDATE usuarios SET user_estado = ? WHERE id_usuario = ?";
                $query = $conexion->prepare($sql);
                $query->bind_param('ii', $estado, $idusuario);
                $respuesta = $query->execute();
                $query->close();
            }
            return $respuesta;
        }

        public function agregarusuario($datos){
            $conexion = Conexion::conectar();
            //CONSULTA AREA
            $idarea = $datos['idarea'];
            $sqlarea = "SELECT a.are_nombre as area FROM areas as a WHERE a.id_area ='$idarea'";
            $resarea = mysqli_query($conexion, $sqlarea);
            $rwarea = mysqli_fetch_array($resarea);
            $area = $rwarea['area'];
            //CONSULTA SEDE
            $idsede = $datos['idsede'];
            $sqlsede = "SELECT s.sed_nombre as sede FROM sedes as s WHERE s.id_sede ='$idsede'";
            $ressede = mysqli_query($conexion, $sqlsede);
            $rwsede = mysqli_fetch_array($ressede);
            $sede = $rwsede['sede'];
            $sql = "INSERT INTO usuarios (id_operador, id_persona, id_sede, id_rol, id_area, user_nombre, user_password) VALUES( ?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("iiiiiss", $datos['idoperador'], $datos['idpersona'], $datos['idsede'], $datos['idrol'], $datos['idarea'], $datos['usuario'], $datos['password']);
            $respuesta = $query->execute();
            if ( $respuesta > 0){
                //REGISTRO AUDITORIA
                $insertbitacora = "INSERT INTO bitacora (bit_tipeve, bit_fecope, bit_operador, bit_modulo, bit_detall, bit_idsede) VALUES (?, ?, ?, ?, ?, ?)";
                $query = $conexion->prepare($insertbitacora);
                $registro = 'REGISTRO';
                $modulo = 'USUARIOS';
                $detalle = 'EL USUARIO ' . $datos['usuario'] . ' EN LA SEDE ' . $sede . ' EN EL AREA ' . $area;
                $query->bind_param("ssissi", $registro, $hoy, $datos['idoperador'], $modulo, $detalle, $idsede);
                $respuesta = $query->execute();
            }
            return $respuesta;
        }

        public function detalleusuario($idusuario){
            $conexion = Conexion::conectar();
            $sql ="SELECT
                u.id_usuario  AS idusuario,
                u.id_persona  AS idpersona,
                p.per_nombre  AS nombre,
                u.user_nombre AS usuario,
                u.user_password AS password,
                u.id_rol      AS idrol,
                r.rol_nombre  AS rol,
                u.id_area     AS idarea,
                u.id_sede     AS idsede,
                u.user_estado AS estado
                FROM usuarios AS u
                INNER JOIN roles AS r ON u.id_rol = r.id_rol
                INNER JOIN personas AS p ON p.id_persona = u.id_persona
                INNER JOIN areas AS a ON a.id_area = u.id_area
                INNER JOIN sedes AS s ON s.id_sede = u.id_sede
                WHERE u.id_usuario ='$idusuario'";
            $respuesta = mysqli_query($conexion,$sql);
            $usuario = mysqli_fetch_array($respuesta);
            $datos = array(
                'idusuario' => $usuario['idusuario'],
                'idpersona' => $usuario['idpersona'],
                'password'  => $usuario['password'],
                'idarea'    => $usuario['idarea'],
                'idsede'    => $usuario['idsede'],
                'idrol'     => $usuario['idrol'],
                'usuario'   => $usuario['usuario'],
                'nombre'    => $usuario['nombre'],
            );
            return $datos;
        }

        public function editarusuario($datos){
            $conexion = Conexion::conectar();
            $sql = "UPDATE usuarios SET id_rol = ?,
                                        id_sede = ?,
                                        id_area = ?,
                                        user_nombre = ?,
                                        user_password = ?
                                        WHERE id_usuario = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('iiissi',
                                $datos['idrol'],
                                $datos['idsede'],
                                $datos['idarea'],
                                $datos['usuario'],
                                $datos['password'],
                                $datos['idusuario']);
            $respuesta = $query->execute();
            if ( $respuesta > 0){
                $hoy = date("Y-m-d");
                $registro = 'MODIFICO';
                $modulo = 'USUARIOS';
                //REGISTRO AUDITORIA
                $insertbitacora = "INSERT INTO bitacora (bit_tipeve, bit_fecope, bit_operador, bit_modulo, bit_detall, bit_idsede) VALUES (?,?,?,?,?,?)";
                $query = $conexion->prepare($insertbitacora);
                $detalle = 'AL USUARIO ' . $datos['usuario'];
                $query->bind_param("ssissi", $registro, $hoy, $datos['idoperador'], $modulo, $detalle, $datos['idsede']);
                $respuesta = $query->execute();
            }
            $query->close();
            return $respuesta;
        }

        public function eliminarusuario($idusuario){
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM usuarios WHERE id_usuario=?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $idusuario);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function detallepass($idusuario){
            $conexion = Conexion::conectar();
            $sql ="SELECT
                u.id_usuario  AS usuarioid
                FROM usuarios AS u
                WHERE u.id_usuario ='$idusuario'";
            $respuesta = mysqli_query($conexion,$sql);
            $usuario = mysqli_fetch_array($respuesta);
            $datos = array(
                'usuarioid' => $usuario['usuarioid'],
            );
            return $datos;
        }

        public function cambiocontraseña($datos){
            $conexion = Conexion::conectar();
            $sql = "UPDATE usuarios SET user_password = ? WHERE id_usuario = ?";
                $query = $conexion->prepare($sql);
                $query->bind_param('si', $datos['newpassword'],
                                        $datos['usuarioid']);
                $respuesta = $query->execute();
            $query->close();
            $hoy = date("Y-m-d");
            $registro = 'CAMBIO';
            $modulo = 'USUARIOS';
            if ( $respuesta > 0){
                //REGISTRO AUDITORIA
                $insertbitacora = "INSERT INTO bitacora (bit_tipeve, bit_fecope, bit_operador, bit_modulo, bit_detall, bit_idsede) VALUES (?,?,?,?,?,?)";
                $query = $conexion->prepare($insertbitacora);
                $detalle = 'SU CONTRASEÑA';
                $query->bind_param("ssissi", $registro, $hoy, $datos['idoperador'], $modulo, $detalle, $sede);
                $respuesta = $query->execute();
                
            }
            return $respuesta;
        }
    }
?>