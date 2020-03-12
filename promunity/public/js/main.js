window.addEventListener("load", function() {

  // Tu código va acá!
})
//funcion mostrar contraseña
function mostrarContrasena() {
    var ojo = document.getElementById("ojo");
    //var pass= document.getElementById('password');
    var pass = document.querySelector('input.password');
    if (pass.type == "password") {
        pass.type = "text";
        ojo.removeAttribute('class');
        ojo.setAttribute('class','fas fa-eye');
    } else {
        pass.type = "password";
        ojo.removeAttribute('class');
        ojo.setAttribute('class','fas fa-eye-slash');
    }
}
//Perfil
function abrirDarUnCurso() {
        closeNav();
        document.getElementById('UserProfileContent').style.display = "none";
        document.getElementById("crearCurso").style.display = "inherit";
    }
    function abrirTab() {
        document.getElementById('crearCurso').style.display = "none";
        document.getElementById('PageSetting').style.display = "none";
        document.getElementById('UserProfileContent').style.display = "inherit";
    }

    function openNav() {
        document.getElementById("sideNavigation").style.width = "200px";
    }

    function closeNav() {
        document.getElementById("sideNavigation").style.width = "0";
    }
//Cierre Perfil
