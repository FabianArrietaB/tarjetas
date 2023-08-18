<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    //CONSULTA RESUMEN
    $sqlunico = "SELECT
        c.id_conciliacion AS idconciliacion,
        c.id_operador    AS idoperador,
        u.user_nombre    AS nombre,
        c.con_franquisia AS franquisia,
        c.con_fecconcil  AS fechaconci
    FROM conciliacion AS c
    INNER JOIN usuarios AS u ON u.id_usuario = c.id_operador";
    $rwunico = mysqli_query($conexion, $sqlunico);
?>
<!-- inicio Tabla -->
<?php if(mysqli_num_rows($rwunico) > 0) { ?>
<div class="table-responsive">
    <table class="table table-primary text-center">
        <thead>
            <tr>
                <th scope="col" >FECHA CONCILIACION</th>
                <th scope="col" >FRANQUISIA</th>
                <th scope="col" >OPERADOR</th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            while ($valor = mysqli_fetch_array($rwunico)) { ?>
                        <tr>
                            <td><?php echo $valor['fechaconci'];?></td>
                            <td><?php echo $valor['franquisia'];?></td>
                            <td><?php echo $valor['nombre'];?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editconciliacion" onclick="detalleconciliacion('<?php echo $valor['idconciliacion']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                            </td>
                        </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } else {
    echo "No hay Datos que Mostrar"
?>
<?php } ?>

<!-- fin de la tabla -->
