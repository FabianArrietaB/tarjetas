<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sql = "SELECT
        p.id_porcentaje as idporcentaje,
        p.por_tipo      as tipo,
        p.por_mes       as mes,
        p.por_tipR      as tipr
        FROM porcentajes AS p";
    $query = mysqli_query($conexion, $sql);
?>
<!-- inicio Tabla -->
<div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Tipo Tarjeta</th>
                <th scope="col" >%</th>
                <th scope="col" >Franquisia</th>
                <!-- <th>
                </th> -->
            </tr>
        </thead>
        <tbody>
        <?php
            while ($porcentajes = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $porcentajes['tipo'];?></td>
                <td>
                    <?php
                    $valor = $porcentajes['mes'] * 100;
                    echo $valor . ' %';
                    ?>
                </td>
                <td><?php echo $porcentajes['tipr']; ?></td>
                <!-- <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar" onclick="detalleusuario('<?php echo $usuarios['idporcentaje']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                </td> -->
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
