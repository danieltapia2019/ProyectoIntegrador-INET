<?php


  $dsn = 'mysql:host=localhost;dbname=promunity_db;port:3306';
  $db_use ="root";
  $db_pass = "";

  function abrirConexion($dsn,$user,$pass){
    try{
      return new PDO($dsn,$user,$pass);
    }
    catch(PDOException $Exception){
      return false;
      }
  }
  $conexion = abrirConexion($dsn,$db_use,$db_pass);
?>
