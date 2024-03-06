<?php
    session_start();
    include "../../model/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['tarid'];
    $sqlprefij = "SELECT
        pu.id id,
        pu.id_usuario iduser,
        u.user_nombre usuario,
        pu.id_prefijo idprefijo,
        p.pre_nombre prefijo,
        s.sed_nombre sede
        FROM prefij_usuario AS pu
        INNER JOIN usuarios AS u ON u.id_usuario = pu.id_usuario
        INNER JOIN prefijos AS p ON p.id_prefij = pu.id_prefijo
        INNER JOIN sedes AS s ON p.id_sede = s.id_sede";
    $querydat = mysqli_query($conexion, $sqlprefij);
    $prefijo ="SELECT
        p.id_prefij idprefij,
        p.pre_nombre prefijo,
        s.sed_nombre sede
    FROM prefijos as p
    INNER JOIN sedes AS s ON s.id_sede = p.id_sede";
    $rwprefijo = mysqli_query($conexion, $prefijo);
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
            <h2>ASIGNAR PREFIJOS</h2>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card-body text-center">
            <form id="frmaddpreuser" method="post" onsubmit="return addpreuser()">
                <div class="row text-center">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Prefijo</span>
                            <select id="idprefij" name="idprefij" class="form-select" aria-label="Default select example" required>
                                <option selected>Seleccione</option>
                                <?php
                                    while($prefij = mysqli_fetch_array($rwprefijo)) {
                                ?>
                                    <option value="<?php echo $prefij['idprefij']?>"><?php echo $prefij['prefijo'] . ' - ' . $prefij['sede'] ?></option>
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
                        <th scope="col" >PREFIJO</th>
                        <th scope="col" >USUARIO</th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($prefijos = mysqli_fetch_array($querydat)){
                ?>
                    <tr>
                        <td><?php echo $prefijos['prefijo'] . ' - ' . $prefijos['sede'];?></td>
                        <td><?php echo $prefijos['usuario'];?></td>
                        <td>
                            <button type="button" class="btn btn-danger"  onclick="eliminarpreuser('<?php echo $prefijos['id']?>')"><i class="fa-regular fa-trash-can fa-beat fa-xl"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- fin de la tabla -->
