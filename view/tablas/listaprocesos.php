<?php
    session_start();
    $año = "";
    $modulo = '';
    $operador = '';
    if(isset($_GET['year'])){
        $año =  $_GET['year'];
    }
    if(isset($_GET['modulo'])){
        $modulo =  $_GET['modulo'];
    }
    if(isset($_GET['operador'])){
        $operador = $_GET['operador'];
    }
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    $sql = "SELECT
        h.id_operador idoperador,
        u.user_nombre nombre,
        h.id_sede idsede,
        h.his_numdoc numdoc,
        h.his_detall detall,
        h.his_modulo modulo,
        h.his_fecope fecha
    FROM historial h
    INNER JOIN usuarios u ON u.id_usuario = h.id_operador
    ORDER BY h.his_fecope DESC";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-light text-center" id="eventos">
        <thead>
            <tr>
                <th scope="col" >DETALLE DE EVENTOS</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($bitacora = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td>
                    <?php echo 'EL <strong>' . $bitacora['fecha'] . '</strong> POR EL USUARIO <strong>' . $bitacora['nombre'] . '</strong>  SE ELIMINO <strong>' .$bitacora['modulo'] . ' ' . $bitacora['numdoc'] . '</strong>  POR <strong>' . $bitacora['detall'] . '</strong>'; ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
