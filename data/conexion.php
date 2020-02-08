<?php

$db_host = "localhost";
$db_nombre = "promunity_db";
$db_usuario = "root";
$db_pass = "";

$conexion = mysqli_connect($db_host, $db_usuario, $db_pass,$db_nombre);

if(mysqli_connect_errno()){
  echo "No se pudo conectar a la Base De Datos";
  exit();
}
 ?>
