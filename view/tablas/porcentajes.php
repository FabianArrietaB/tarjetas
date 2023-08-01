<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectarbd();
    $idusuario = $_SESSION['usuario']['id'];
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
                <th scope="col" >tipo</th>
                <th scope="col" >mes</th>
                <th scope="col" >tipr</th>
                <th>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create"><i class="fa-solid fa-square-plus fa-lg"></i></button>
                    </div>
                </th>
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
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar" onclick="detalleusuario('<?php echo $usuarios['idusuario']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- fin de la tabla -->
