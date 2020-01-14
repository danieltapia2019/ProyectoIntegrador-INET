<?php

class Usuario{
  private $id;
  private $username;
  private $email;
  private $password;
  private $foto;

  /*CONSTRUCTOR*/

  public function __construct($username, $email, $password){
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password,PASSWORD_DEFAULT);
  }
  /*GETTERS AND SETTERS*/
  public function setUserName($username){
    $this->username = $username;
  }
  public function getUserName(){
    return $this->username;
  }

  public function setEmail($email){
    $this->email = $email;
  }
  public function getEmail(){
    return $this->email;
  }

  public function setPassword($password){
    $this->password = password_hash($password,PASSWORD_DEFAULT);
  }
  public function getPassword(){
    return $this->password;
  }

  public function setId($id){
    $this->id = $id;
  }
  public function getId($id){
    return $this->id;
  }

  public function setFoto($foto){
    $this->foto = $foto;
  }
  public function getFoto(){
    return $this-> foto;
  }





}





 ?>
