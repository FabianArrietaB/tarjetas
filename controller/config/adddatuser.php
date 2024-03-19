<?php
   session_start();
   $datos = array(
      'idoperador' => $_SESSION['usuario']['tarid'],
      "iddatafo"   => $_POST['iddatafo'],
      "idusuario"  => $_POST['idusuario'],
   );

   include "../../model/config.php";
   $Datafono = new Config();
   echo $Datafono->adddatuser($datos);
?>