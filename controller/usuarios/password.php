<?php
   session_start();
   $datos = array(
   'idoperador'  => $_SESSION['usuario']['id'],
   "usuarioid"   => $_POST['usuarioid'],
   "newpassword" => md5($_POST['newpassword']),
   );

   include "../../models/usuarios.php";
   $Usuarios = new Usuarios();
   echo $Usuarios->cambiocontraseña($datos);
?>