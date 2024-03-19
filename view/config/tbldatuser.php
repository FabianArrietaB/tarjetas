<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sqldatafo = "SELECT
        du.id id,
        du.id_usuario iduser,
        u.user_nombre usuario,
        du.id_datafono datafono,
        d.dat_nombre datafono,
        s.sed_nombre sede
        FROM data_usuario AS du
        INNER JOIN usuarios AS u ON u.id_usuario = du.id_usuario
        INNER JOIN datafonos AS d ON d.id_datafono = du.id_datafono
        INNER JOIN sedes AS s ON d.id_sede = s.id_sede";
    $querydat = mysqli_query($conexion, $sqldatafo);
    $datafono ="SELECT
        d.id_datafono as iddata,
        d.dat_nombre as datafo
    FROM datafonos as d
    WHERE d.dat_estado = 1";
    $rwdatafono = mysqli_query($conexion, $datafono);
    $usuarios ="SELECT
        u.id_usuario as idusuario,
        u.user_nombre as nombre
    FROM usuarios as u
    WHERE u.user_estado = 1";
    $rwusuario = mysqli_query($conexion, $usuarios);
?>
<!-- inicio Tabla -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="title">
            <h2>ASIGNAR DATAFONOS</h2>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card-body text-center">
            <form id="frmadddatuser" method="post" onsubmit="return adddatuser()">
                <div class="row text-center">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Datafono</span>
                            <select id="iddatafo" name="iddatafo" class="form-select" aria-label="Default select example" required>
                                <option selected>Seleccione</option>
                                <?php
                                    while($data = mysqli_fetch_array($rwdatafono)) {
                                ?>
                                    <option value="<?php echo $data['iddata']?>"><?php echo $data['datafo'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Usuario</span>
                            <select id="idusuario" name="idusuario" class="form-select" aria-label="Default select example" required>
                                <option selected>Seleccione</option>
                                <?php
                                    while($user = mysqli_fetch_array($rwusuario)) {
                                ?>
                                    <option value="<?php echo $user['idusuario']?>"><?php echo $user['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-sm" >Agregar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <table class="table table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" >DATAFONO</th>
                        <th scope="col" >USUARIO</th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($datafono = mysqli_fetch_array($querydat)){
                ?>
                    <tr>
                        <td><?php echo $datafono['datafono'] . ' - ' . $datafono['sede'] ;?></td>
                        <td><?php echo $datafono['usuario'];?></td>
                        <td>
                            <button type="button" class="btn btn-danger"  onclick="eliminardatuser('<?php echo $datafono['id']?>')"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- fin de la tabla -->
