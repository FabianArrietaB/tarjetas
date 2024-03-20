<?php
    $idusuario = $_SESSION['usuario']['tarid'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TARJETAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-md-flex d-block flex-row mx-md-auto mx-0">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if ($_SESSION['usuario']['tarrol'] == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registros.php">REGISTROS</a>
                    </li>
                <?php } else if ($_SESSION['usuario']['tarrol'] == 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registros.php">REGISTROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="consultas.php">GENERAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="conciliacion.php">CONCILIACION</a>
                    </li>
                <?php } else if ($_SESSION['usuario']['tarrol'] == 5) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registros.php">REGISTROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cartera.php">CARTERA</a>
                    </li>
                <?php } else if ($_SESSION['usuario']['tarrol'] == 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registros.php">REGISTROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="consultas.php">GENERAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="conciliacion.php">CONCILIACION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cartera.php">CARTERA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="inactivos.php">DOCUMENTOS INACTIVOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="config.php">PERMISOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="usuarios.php">USUARIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="historial.php">HISTORIAL</a>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
        <span class="navbar-brand" href="#">Usuario:</span>
        <a class="mr-sm-2 btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#contraseña" onclick="detallepass('<?php echo $idusuario ?>')"><?php echo $_SESSION['usuario']['tarusuario'] ?></a>
        <a href="../controller/usuarios/salir.php" class="btn btn-danger" type="submit">
            <i class="fa-solid fa-power-off fa-2x"></i>
        </a>
    </div>
</nav>
<?php
    include "../view/usuarios/cambiarcontraseña.php";
?>