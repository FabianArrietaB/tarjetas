<?php
    date_default_timezone_set('America/Bogota');
    include "conexion.php";

    class Cartera extends Conexion {

        public function clientes(){
            $con = new Conexion();
            $sql = $con->conectarFomplus()->prepare('SELECT
                v.VEN_CEDULA docume,
                v.VEN_NOMBRE vendedor,
                v.VEN_ACTIVO activo,
                SUM(sc.valor_saldo) saldo
            from METROPOLIS_EXT.cartera.saldos_clientes sc
            LEFT JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
            LEFT JOIN METROCERAMICA.dbo.MAEVEN v ON v.VEN_CEDULA = c.CLI_VENDED
            GROUP BY v.VEN_CEDULA, v.VEN_NOMBRE, v.VEN_ACTIVO
            ORDER BY v.VEN_ACTIVO');
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function cliente_vendedor($docume){
            $con = new Conexion();
            $sql = $con->conectarFomplus()->prepare('SELECT
                c.CLI_NOMBRE cliente,
                c.CLI_CEDULA nit,
                sc.vendedor vendedor,
                    SUM(CASE WHEN dias_vencimiento < 1 THEN valor_saldo ELSE 0 END) por_vencer,
                    SUM(CASE WHEN dias_vencimiento BETWEEN 1 AND 30 THEN valor_saldo ELSE 0 END) dias_1_a_30,
                    SUM(CASE WHEN dias_vencimiento BETWEEN 31 AND 60 THEN valor_saldo ELSE 0 END) dias_31_a_60,
                    SUM(CASE WHEN dias_vencimiento BETWEEN 61 AND 90 THEN valor_saldo ELSE 0 END) dias_61_a_90,
                    SUM(CASE WHEN dias_vencimiento > 90 THEN valor_saldo ELSE 0 END) dias_mayor_90,
                    SUM(sc.valor_saldo) saldo
            from METROPOLIS_EXT.cartera.saldos_clientes sc
            LEFT JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
            LEFT JOIN METROCERAMICA.dbo.MAEVEN v ON v.VEN_CEDULA = c.CLI_VENDED
            WHERE c.CLI_VENDED  = ?
            GROUP BY c.CLI_NOMBRE, c.CLI_CEDULA, sc.vendedor');
            $sql->execute(array($docume));
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function facturas($nit){
            $con = new Conexion();
            $sql = $con->conectarFomplus()->prepare("SELECT
                CONCAT(sc.prefijo,' - '  ,sc.numero_documento) factura,
                sc.fecha fecha,
                sc.tipo_documento docume,
                sc.vendedor  vendedor,
                sc.valor valor,
                sc.valor_abono abono,
                sc.valor_saldo saldo,
                c.CLI_NOMBRE  cliente,
                c.CLI_TELEFO telefo,
                c.CLI_DIRECC direcc,
                c.CLI_EMAIL	 correo
            FROM METROPOLIS_EXT.cartera.saldos_clientes sc
            INNER JOIN METROCERAMICA.dbo.MAECXC c ON c.CLI_CEDULA = sc.nit
            WHERE nit = ?");
            $sql->execute(array($nit));
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function pedido($pedido){
            $con = new Conexion();
            $newpedido = '%'. str_pad($pedido, 9 ,"0",STR_PAD_LEFT) . '%';
            $sql = $con->conectarFomplus()->prepare("SELECT
                p.PED_NUMPED pedido,
                p.PED_PREFIJ preped,
                r.REM_PREFIJ prerem,
                r.REM_NUMREM numrem,
                r.REM_PREFAC prefac,
                r.REM_NUMFAC numfac,
                p.PED_CEDULA cedula,
                c.CLI_NOMBRE client,
                p.PED_FECPED fecped,
                p.PED_FECVEN fecven,
                p.PED_PLAZO  dias,
                p.PED_VENDED vende,
                p.PED_TIPCTA tipcta,
                a.ALM_NOMBRE bodega,
                p.PED_OBSERV observ,
                p.PED_DIRENV direcc,
                p.PED_CODOPE operad,
                p.PED_FECOPE fecope,
                p.PED_USUARIO usuari,
                p.PED_VALPED valor,
                p.PED_FECAUT fecaut,
                p.PED_IVAUTI  ivauti
            FROM METROCERAMICA.dbo.MAEPEDCXC p
            INNER JOIN METROCERAMICA.dbo.MAECXC c ON p.PED_CEDULA = c.CLI_CEDULA
            INNER JOIN METROCERAMICA.dbo.MAEREMCXC r ON p.PED_NUMPED = r.REM_NUMPED
            INNER JOIN METROCERAMICA.dbo.MAEALM a ON p.PED_BODEGA = a.ALM_CODIGO
            WHERE p.PED_NUMPED LIKE ?");
            $sql->execute(array($newpedido));
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

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