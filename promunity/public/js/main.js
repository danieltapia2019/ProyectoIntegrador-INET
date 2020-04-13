window.addEventListener("load", function () {
    // Tu código va acá!
})
//funcion mostrar contraseña
function mostrarContrasena() {
    var ojo = document.getElementById("ojo");
    //var pass= document.getElementById('password');
    //var pass = document.querySelector('input.password');
    var pass = document.querySelector('input[name=password]');
    if (pass.type == "password") {
        pass.type = "text";
        ojo.removeAttribute('class');
        ojo.setAttribute('class', 'fas fa-eye');
    } else {
        pass.type = "password";
        ojo.removeAttribute('class');
        ojo.setAttribute('class', 'fas fa-eye-slash');
    }
}
//Perfil

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".btn-submit-opinion").click(function(e){
  e.preventDefault();
  var opinion = $("textarea[name=opinion]").val();
  $.ajax({
    type:'POST',
    url:'http://localhost:8000/opinion',
    data:{opinion: opinion},
    success:function(data){
      console.log(data);
      alert('Opinion Creada CORRECTAMENTE');
      $("textarea[name=opinion]").val('');
    },
    error:function(e){
      alert('ERROR '+e);
    },
  })
});
function abrirDarUnCurso() {
    closeNav();
}

function openNav() {
    document.getElementById("sideNavigation").style.width = "200px";
}

function closeNav() {
    document.getElementById("sideNavigation").style.width = "0";
}
//Cierre Perfil

//ABM

//CIERRE ABM
