<?php
    session_start();
    include "../../model/conexion.php";
    $desde = "";
    $hasta = "";
    $sede = "";
    $master = "";
    $visa = "";
    $davi = "";
    if(isset($_GET['desde']) && ($_GET['hasta'])){
        $desde = $_GET['desde'];
        $hasta = $_GET['hasta'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    if(isset($_GET['master'])){
        $master = $_GET['master'];
    }
    if(isset($_GET['visa'])){
        $visa = $_GET['visa'];
    }
    if(isset($_GET['davi'])){
        $davi = $_GET['davi'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    //CONSULTA RESUMEN
    $sqlunico = "SELECT
        c.id_conciliacion AS idconciliacion,
        s.sed_nombre AS sede,
        c.id_operador    AS idoperador,
        u.user_nombre    AS nombre,
        c.con_franquicia AS franquicia,
        c.con_estado     AS estado,
        c.con_fecconcil  AS fechaconci
    FROM conciliacion AS c
    INNER JOIN usuarios AS u ON u.id_usuario = c.id_operador
    INNER JOIN sedes AS s ON s.id_sede = c.id_sede
    WHERE c.con_fecconcil BETWEEN '$desde' AND '$hasta'";
    if ($sede != ""){
        $sqlunico .="AND c.id_sede = '$sede'";
    }
    if($master != "" && $visa == "" && $davi == ""){
    $sqlunico .=" AND c.con_franquicia = '$master'";
    } else if ($master == "" && $visa !="" && $davi == "" ){
        $sqlunico .=" AND c.con_franquicia = '$visa'";
    } else if ($master == "" && $visa == "" && $davi != "" ){
        $sqlunico .=" AND c.con_franquicia = '$davi'";
    } else if ($master !="" && $visa !="" && $davi == "" ){
        $sqlunico .=" AND c.con_franquicia IN ('$master', '$visa')";
    } else if ($master !="" && $visa == "" && $davi != "" ){
        $sqlunico .=" AND c.con_franquicia IN ('$master', '$davi')";
    } else if ($master == "" && $visa != "" && $davi != "" ){
        $sqlunico .=" AND c.con_franquicia IN ('$davi', '$visa')";
    }
    $sqlunico .="ORDER BY c.con_fecconcil DESC";
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
                <th scope="col" >SEDE</th>
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
                            <td><?php echo $valor['franquicia'];?></td>
                            <td><?php echo $valor['sede'];?></td>
                            <td><?php echo $valor['nombre'];?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editconciliacion" onclick="detalleconciliacion('<?php echo $valor['idconciliacion']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                                <?php
                                if ($valor['estado'] == 1) {
                                ?>
                                <button type="button" class="btn btn-danger" onclick="eliminarconciliacion(<?php echo $valor['idconciliacion']?>, <?php echo $valor['estado'] ?>)"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                                <?php
                                } else if ($valor['estado'] == 0) {
                                ?>
                                <button type="button" class="btn btn-success" onclick="eliminarconciliacion(<?php echo $valor['idconciliacion']?>, <?php echo $valor['estado'] ?>)"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                                 <?php
                                }
                                ?>
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
