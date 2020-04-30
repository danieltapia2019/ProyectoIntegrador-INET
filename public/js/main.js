//funcion mostrar contraseña
function mostrarContrasena() {
    var ojo = document.getElementById("ojo");
    //var pass= document.getElementById('password');
    var pass = document.querySelector('input.password');
    //var pass = document.querySelector('input[name=password]');
    console.log(pass);
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

  if(opinion == null){
    alert('Error Escriba su opinion')
  }else{
  $.ajax({
    type:'POST',
    url:'http://localhost:8000/opinion',
    data:{opinion: opinion},
    success:function(data){
      console.log(data);
      $.alert({
      title: 'Exito!',
      content: 'Opinion creada correctamente desde ya muchas gracias!!!',
      });
      $("textarea[name=opinion]").val('');
    },
    error:function(e){
      alert('ERROR '+e);
    },
  })
  }
});


function cerrarNav() {
    closeNav();
    var home = $("#nav-home-tab").attr('aria-selected');
    var profile = $("#nav-profile-tab").attr('aria-selected');
    var contacto = $("nav-contact-tab").attr('aria-selected');
    if(home || profile || contacto){
    $("#nav-home-tab").attr('class','nav-item nav-link');
    $("#nav-profile-tab").attr('class','nav-item nav-link');
    $("nav-contact-tab").attr('class','nav-item nav-link');
    }
}
function cerrarTab(){
  var crearCurso = $("#nav-create-tab").attr('aria-selected');
  var cursoCreado = $("nav-created-tab").attr('aria-selected');
  if(crearCurso || cursoCreado){
  $("#nav-create-tab").attr('class','nav-item nav-link');
  $("#nav-created-tab").attr('class','nav-item nav-link');
  }
}
function openNav() {
    document.getElementById("sideNavigation").style.width = "200px";
}

function closeNav() {
    document.getElementById("sideNavigation").style.width = "0";
}
//Cierre Perfil
//Previsualizacion imagen
$(function() {
  $('#file-input').change(function(e) {
      addImage(e);
     });

     function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;

      if (!file.type.match(imageType))
       return;

      var reader = new FileReader();

      reader.onload = function(e){
         var result=e.target.result;
        $('#imgSalida').attr("src",result);
      }

      reader.readAsDataURL(file);
     }
    });
//ABM

//CIERRE ABM
