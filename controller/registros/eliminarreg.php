<?php
     session_start();
     $datos = array(
      'idoperador'     => $_SESSION['usuario']['id'],
      "idregistro"     => $_POST['idregistro'],
      "estado"         => $_POST['eliestado'],
      "ticket"         => $_POST['eliticket'],
      "idsede"         => $_POST['eliidsede'],
      "detalle"         => $_POST['detalle'],
     );
     include "../../model/registros.php";
     $Registros = new Registros();
     echo $Registros->eliminarregistro($datos);
?>