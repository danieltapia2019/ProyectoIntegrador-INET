//USUARIOS

function validarCamposUsuario(username,email,password,password_confirm){
  var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._]+\.[a-zA-z]{2,6}$/;
  if(username == "" || email == ""  || password == "" || password_confirm == ""){
    return 1;
  }else if (password.length <= 7){
    return 2;
  }else if(password != password_confirm){
    return 3;
  }else if(regex.test(email) == false){
    return 4;
  }else if(username.length < 5 || username.length > 25   || email.length < 10 || email.length > 25 ){
    return 5;
  }else{
    return 0;
  }/*
  1-CAMPOS VACIOS
  2-LA CONTRASEÑA DEBE SER MAYOR A 8
  3-LAS CONTRASEÑAS DEBEN SER IGUALES
  4-EL EMAIL DEBE CONTENER UN @
  5-EL TAMAÑO EXCEDE LO PERMITIDO
  0-TODO OK
  */
}

//CURSOS

//TIPOS

//USOS
function validarCamposNombres(nombre){
  if(nombre.length < 4 || nombre.length > 50 ){
  return 1;
}else if (typeof(nombre) !== 'string') {
  return 2;
  }
  return 0;
}
//Lenguaje
function validarCamposLenguajes(nombre){
  if(nombre.length < 1 || nombre.length > 25 ){
  return 1;
}else if (typeof(nombre) !== 'string') {
  return 2;
  }
  return 0;
}
