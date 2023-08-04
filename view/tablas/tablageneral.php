<?php
    session_start();
    include "../../model/conexion.php";
    $hoy = "";
    $sede = "";
    if(isset($_GET['dategen'])){
        $hoy = $_GET['dategen'];
    }
    if(isset($_GET['sede'])){
        $sede = $_GET['sede'];
    }
    $con = new Conexion();
    $conexion = $con->conectar();
    $idusuario = $_SESSION['usuario']['id'];
    $sqlgeneral = "SELECT
        r.id_registro     as idregistro,
        r.id_operador     as idoperador,
        r.reg_tiptar      as tiptar,
        SUM(r.reg_diferencia) as diferencia,
        SUM(r.reg_rtefte)     as retefuente,
        SUM(r.reg_rteiva)     as reteiva,
        SUM(r.reg_rteica)     as reteica,
        SUM(r.reg_comision)   as comision
    FROM registros  AS r
    WHERE r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlgeneral .=" AND r.id_sede = '$sede'";
    }
    $sqlgeneral .="GROUP BY r.reg_tiptar";
    $rwgeneral = mysqli_query($conexion, $sqlgeneral);
    $sqlunico = "SELECT
        r.id_registro     AS idregistro,
        r.id_operador     AS idoperador,
        CONCAT(r.reg_tiptar, ' ' ,u.user_nombre) AS caja,
        r.reg_tiptar      AS tiptar,
        SUM(r.reg_diferencia) AS diferencia,
        SUM(r.reg_rtefte)     AS retefuente,
        SUM(r.reg_rteiva)     AS reteiva,
        SUM(r.reg_rteica)     AS reteica,
        SUM(r.reg_comision)   AS comision
    FROM registros  AS r
    INNER JOIN usuarios AS u ON u.id_usuario = r.id_operador
    WHERE r.reg_fecope = '$hoy'";
    if($sede != ""){
        $sqlunico .=" AND r.id_sede = '$sede'";
    }
    $sqlunico .="GROUP BY r.reg_tiptar, r.id_operador";
    $rwunico = mysqli_query($conexion, $sqlunico);
?>
<!-- inicio Tabla -->

<div class="table-responsive">
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col" >Tarjeta | Caja</th>
                <th scope="col" >Diferencia</th>
                <th scope="col" >Rte Fte</th>
                <th scope="col" >Rte IVA</th>
                <th scope="col" >Rte ICA</th>
                <th scope="col" >Comision</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($valor = mysqli_fetch_array($rwunico)){
            ?>
            <tr>
                <td><?php echo $valor['caja'];?></td>
                <td><?php echo '$ ' . number_format(round($valor['diferencia']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['retefuente']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteiva']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['reteica']));?></td>
                <td><?php echo '$ ' . number_format(round($valor['comision']));?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="container-fluid">
        <form id="frmadddiferencia" method="post" onsubmit="return adddiferencia()">
            <?php
                while ($valor = mysqli_fetch_array($rwgeneral)){
            ?>
            <div class="row text-center">
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label"><?php echo $valor['tiptar'] ?></label>
                        <input hidden type="text">
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">TOTAL DIFERENCIAS</label>
                        <input type="text" class="form-control text-center" name="bandif" id="bandif" value="<?php echo '$ ' . number_format(round($valor['diferencia']))?>" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">VALOR BANCO</label>
                        <input type="text" class="form-control text-center" name="difban" id="difban" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">DIFERENCIA</label>
                        <input type="text" class="form-control text-center" name="difbanbd" id="difbanbd" placeholder="000000" readonly>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">TOTAL RETEFUENTE</label>
                        <input type="text" class="form-control text-center" name="banretfte" id="banretfte" value="<?php echo '$ ' . number_format(round($valor['retefuente']))?>" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">VALOR BANCO</label>
                        <input type="text" class="form-control text-center" name="difban" id="difban" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">DIFERENCIA</label>
                        <input type="text" class="form-control text-center" name="banvsbd" id="banvsbd" placeholder="000000" readonly>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">TOTAL RETEIVA</label>
                        <input type="text" class="form-control text-center" name="banretiva" id="banretiva" value="<?php echo '$ ' . number_format(round($valor['reteiva']))?>" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">VALOR BANCO</label>
                        <input type="text" class="form-control text-center" name="difban" id="difban" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">DIFERENCIA</label>
                        <input type="text" class="form-control text-center" name="banvsbd" id="banvsbd" placeholder="000000" readonly>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">TOTAL RETEICA</label>
                        <input type="text" class="form-control text-center" name="banretica" id="banretica" value="<?php echo '$ ' . number_format(round($valor['reteica']))?>" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">VALOR BANCO</label>
                        <input type="text" class="form-control text-center" name="difban" id="difban" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">DIFERENCIA</label>
                        <input type="text" class="form-control text-center" name="banvsbd" id="banvsbd" placeholder="000000" readonly>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">TOTAL COMISION</label>
                        <input type="text" class="form-control text-center" name="bancomi" id="bancomi" value="<?php echo '$ ' . number_format(round($valor['comision']))?>" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">VALOR BANCO</label>
                        <input type="text" class="form-control text-center" name="difban" id="difban" placeholder="000000" required>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">DIFERENCIA</label>
                        <input type="text" class="form-control text-center" name="banvsbd" id="banvsbd" placeholder="000000" readonly>
                    </div>
                </div>
            </div>
            <?php } ?>
                <div class="row">
                    <div class="col-12">
                        <div >
                            <button type="submit" class="btn btn-success" >Agregar</button>
                        </div>
                    </div>
                </div>
           
        </form>
    </div>
</div>
<!-- fin de la tabla -->
