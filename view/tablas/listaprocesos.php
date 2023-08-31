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
        h.id_sede idsede,
        h.his_numdoc numdoc,
        h.his_detall detall,
        h.his_modulo modulo,
        h.his_fecope fecha
    FROM historial h
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
                    <?php echo 'EL <strong>' . $bitacora['fecha'] . '</strong> POR EL USUARIO <strong>' . $bitacora['idoperador'] . ' SE ELIMINO ' .$bitacora['modulo'] . ' ' . $bitacora['numdoc'] . ' POR ' . $bitacora['detall'] . '</strong>'; ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
