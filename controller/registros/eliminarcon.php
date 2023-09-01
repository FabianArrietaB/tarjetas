<?php
     session_start();
     $datos = array(
      'idoperador'     => $_SESSION['usuario']['id'],
      "idconciliacion" => $_POST['idconciliacion'],
      "estado"         => $_POST['eliestadocon'],
      "fecha"          => $_POST['elifechacom'],
      "idsede"         => $_POST['eliidsedecom'],
      "detalle"        => $_POST['detallecon'],
     );
     include "../../model/registros.php";
     $Registros = new Registros();
     echo $Registros->eliminarregistro($datos);
?>