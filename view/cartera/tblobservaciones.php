<?php
    session_start();
    $filtro = '';
    if(isset($_GET['filtro'])){
        $filtro = $_GET['filtro'];
    }
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sql = "SELECT
        c.id_cartera  AS idcartera,
        c.id_operador AS idoperador,
        CONCAT(c.car_nitcli, ' - ' ,c.car_nombre) cliente,
        c.car_obser   AS detalle,
        c.car_fecope  AS fecope
    FROM cartera AS c
    WHERE c.car_nitcli LIKE  '%$filtro%' || c.car_nombre  LIKE '%$filtro%'
    ORDER BY c.car_nombre ASC";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-light text-center" id="observaciones">
        <thead>
            <tr>
                <th scope="col" >#</th>
                <th scope="col" >NIT - CLIENTE</th>
                <th scope="col" >OBSERVACION</th>
                <th scope="col" >FECHA</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($clientes = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $clientes['idcartera'];?></td>
                <td><?php echo $clientes['cliente'];?></td>
                <td><?php echo $clientes['detalle'];?></td>
                <td><?php echo $clientes['fecope'];?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
