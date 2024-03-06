<?php
   session_start();
   $datos = array(
   'idoperador' => $_SESSION['usuario']['tarid'],
   "idprefij"   => $_POST['idprefij'],
   "idusuario"  => $_POST['idusuario'],
   );

   include "../../model/config.php";
   $Prefijo = new Config();
   echo $Prefijo->addpreuser($datos);
?>