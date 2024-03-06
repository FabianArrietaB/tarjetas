<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sqldatafo = "SELECT
        d.id_datafono iddatafono,
        d.id_sede idsede,
        s.sed_nombre sede,
        d.dat_serial serial,
        d.dat_nombre datafono
        FROM datafonos AS d
        INNER JOIN sedes AS s ON s.id_sede = d.id_sede";
    $querydat = mysqli_query($conexion, $sqldatafo);
    $sqlprefij = "SELECT
        p.id_prefij idprefijo,
        p.id_sede idsede,
        s.sed_nombre sede,
        p.pre_nombre prefijo
        FROM prefijos AS p
        INNER JOIN sedes AS s ON s.id_sede = p.id_sede";
    $querypre = mysqli_query($conexion, $sqlprefij);
?>
<!-- inicio Tabla -->
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="title">
            <h2>DATAFONOS</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" >NOMBRE</th>
                        <th scope="col" >SERIAL</th>
                        <th scope="col" >SEDE</th>
                        <th>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adddatafono"><i class="fa-solid fa-square-plus fa-lg"></i></button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($datafono = mysqli_fetch_array($querydat)){
                ?>
                    <tr>
                        <td ondblclick="eliminardatafono('<?php echo $datafono['iddatafono']?>')"><?php echo $datafono['datafono'] ;?></td>
                        <td><?php echo $datafono['serial'];?></td>
                        <td><?php echo $datafono['sede'];?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarfolder" onclick="detallefolder('<?php echo $folder['iddatafono']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="col-xs-12 col-sm-6 col-md-10">
            <div class="title">
                <h2>PREFIJOS</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" >NOMBRE</th>
                        <th scope="col" >SEDE</th>
                        <th>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addprefijo"><i class="fa-solid fa-square-plus fa-lg"></i></button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($prefijos = mysqli_fetch_array($querypre)){
                ?>
                    <tr ondblclick="eliminarprefijo('<?php echo $prefijos['idprefijo']?>')">
                        <td><?php echo $prefijos['prefijo'];?></td>
                        <td><?php echo $prefijos['sede'];?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarfolder" onclick="detallefolder('<?php echo $folder['idprefijo']?>')"><i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- fin de la tabla -->
