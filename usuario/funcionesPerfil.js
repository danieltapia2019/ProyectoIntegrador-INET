function abrirFavoritos() {
  document.getElementById("sideNavigation").style.width = "0";
  document.getElementById('perfil').style.display = "none";
}

function abrirMisCursos() {
  document.getElementById("sideNavigation").style.width = "0";
  document.getElementById('perfil').style.display = "none";
  document.getElementById('config').style.display = "none";
  document.getElementById("misCursos").style.display = "inherit";
}

function abrirPerfil() {
  document.getElementById("sideNavigation").style.width = "0";
  document.getElementById("misCursos").style.display = "none";
  document.getElementById('config').style.display = "none";
  document.getElementById('perfil').style.display = "inherit";
}
function abrirConfiguracion() {
  document.getElementById("sideNavigation").style.width = "0";
  document.getElementById('misCursos').style.display = "none";
  document.getElementById('perfil').style.display = "none";
  document.getElementById('config').style.display = "inherit";
}

function openNav() {
  document.getElementById("sideNavigation").style.width = "200px";
}

function closeNav() {
  document.getElementById("sideNavigation").style.width = "0";
}

function mostrarContrasena() {
  var tipoLogin = document.getElementById("password");
  var ojoLogin = document.getElementById("ojoOn");
  var tipoRegister = document.getElementById("passwordRegister");
  var ojoRegister = document.getElementById("ojoRegister");
  if (tipoLogin.type == "password") {
    tipoLogin.type = "text";
    ojoLogin.name = "eye-off";
  } else {
    tipoLogin.type = "password";
    ojoLogin.name = "eye";
  }
  if (tipoRegister.type == "password") {
    tipoRegister.type = "text";
    ojoRegister.name = "eye-off";
  } else {
    tipoRegister.type = "password";
    ojoRegister.name = "eye";
  }
}