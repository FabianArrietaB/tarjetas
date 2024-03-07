<?php
    include "conexion.php";

    class Config extends Conexion {

        public function adddatuser($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO data_usuario ( id_operador, id_datafono, id_usuario) VALUES( ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("iii", $datos['idoperador'], $datos['iddatafo'], $datos['idusuario']);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function eliminardatuser($id){
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM data_usuario WHERE id = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $id);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function addpreuser($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO prefij_usuario ( id_operador, id_prefijo, id_usuario) VALUES( ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("iii", $datos['idoperador'], $datos['idprefij'], $datos['idusuario']);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function eliminarpreuser($id){
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM prefij_usuario WHERE id = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $id);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function adddatafono($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO datafonos ( id_operador, id_sede, dat_serial, dat_nombre) VALUES( ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("iiss",  $datos['idoperador'], $datos['idsede'], $datos['serial'], $datos['datafono']);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function eliminardatafono($iddatafono){
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM datafonos WHERE id_datafono = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $iddatafono);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function addprefijo($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO prefijos ( id_operador, id_sede, pre_nombre) VALUES( ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("iis", $datos['idoperador'], $datos['idsede'], $datos['nombre']);
            $respuesta = $query->execute();
            return $respuesta;
        }

        public function eliminarprefijo($idprefijo){
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM prefijos WHERE id_prefij = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $idprefijo);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }
    }
?>