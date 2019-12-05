<?php
//0=nombre de usuario en uso
//1=email en uso
//-1=todo correcto
$errorExistente="-1";
if($_POST){
  $json=file_get_contents("../data/usuarios.txt");
  $info=json_decode($json,true);
  $usuario=["id"=>count($info),
  "username"=>$_POST["username"],
  "email"=>$_POST["email"],
  "password"=>password_hash($_POST["password"],PASSWORD_DEFAULT),
  ];
  if(count($info)>0){
    for($i=0;$i< count($info);$i++){
      if($info[$i]["username"] == $usuario["username"]){
        $errorExistente = 0;
        break;
      }
      else if($info[$i]["email"] == $usuario["email"]){
        $errorExistente = 1;
        break;
      }
    }
  }
  if($errorExistente==-1){
    $info[]=$usuario;
    var_dump($info);
    $json=json_encode($info);
    file_put_contents("data/usuarios.txt",$json);
    session_start();
    $_SESSION["usuario"]=$usuario;
    header('Location:./../perfil1.php');
  }
}
 ?>
