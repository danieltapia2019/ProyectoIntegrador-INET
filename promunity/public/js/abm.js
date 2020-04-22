
/*ABM CREAR USUARIO*/
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document).on('click','.activar',function(e){
    e.preventDefault();
    let element=$(this)[0];
    let url=$(element).attr("href");
    let id=$(element).attr("tranId");
    let estado=$("td[id="+id+"]")[0];

    $.post(url,function(response){

        console.log(response.mensaje)
        alert(response.mensaje);
        estado.innerHTML="Pagado"
        element.disabled=true;
        element.className="btn btn-danger"


    }).fail(function(){
        console.log("esto no funca")
    })
})
$(".btn-agregar").click(function(e){
  e.preventDefault();
})
$(".btn-submit-user").click(function(e){
  e.preventDefault();
  var username = $("input[name=username]").val();
  var email = $("input[name=email]").val();
  var password = $("input[name=password]").val();
  var acceso = $("select[name=acceso]").val();
  var campos = validarCamposUsuario(username,email,password,$("input[name=password_confirmation]").val());
  switch (campos) {
    case 1: alert('HAY CAMPOS VACIOS');break;
    case 2: alert('LA CONTRASEÑA TIENE QUE TENER MINIMO 8 CARACTERES');break;
    case 3: alert('LA CONTRASEÑAS NO COINCIDEN');break;
    case 4: alert('EL EMAIL NO UTILIZA @');break;
      break;
    default:
  }
  if(campos == 0){
        $.ajax({
           type:'POST',
           url:'http://localhost:8000/crear/usuario',
           data:{id:0,username: username, email:email , password:password,acceso:acceso},
           success:function(data){
             if(data.status == 'failure'){
                 alert('ERROR YA EXISTE UN REGISTRO CON EL TIPO DE EMAIL y/o USUARIO');
                 $('#modalUsuario').modal('hide');
                 $("input[name=username]").val("");
                 $("input[name=email]").val("");
                 $("input[name=password]").val("");
                 $("input[name=password_confirmation]").val("");
                 return false;
             }
            console.log(data);
            var tr_str = "<tr>"+
            "<td>" + data.id + "</td>"+
            "<td>" + data.username + "</td>" +
            "<td>"+data.email+ "</td>" +
            "<td>"+
            "<div class='row'>"+
                    "<button type='button' onclick='borrarRegistro("+data.id+",this,1)' name='button' class='btn-delete btn btn-danger'>Borrar</button>"+
                    "<hr>"+
                    "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario("+data.id+",this'>Editar</button>"+
              "</div>"+
            "</tr>";
            $(".usuarios tbody").append(tr_str);
            alert('Creado correctamente');
            $("input[name=username]").val("");
            $("input[name=email]").val("");
            $("input[name=password]").val("");
            $("input[name=password_confirmation]").val("");
            $('#modalUsuario').modal('hide');
           },
           error:function(e){
             alert('ERROR NO SE PUDO CREAR EL USUARIO (TIPO DE ERROR => '+e+' )')
           }
        });
    }
});
/*ABM BORRAR*/
  /*ABM BORRAR USUARIO*/
function borrarRegistro(id,boton,url){
    var url;
    switch (url) {
      case 1: url= 'http://localhost:8000/borrar/usuario/';break;
      case 2: url = 'http://localhost:8000/borrar/curso/';break;
      case 3: url = 'http://localhost:8000/borrar/tipo/';break;
      case 4: url = 'http://localhost:8000/borrar/uso/';break;
      case 5: url = 'http://localhost:8000/borrar/lenguaje/';break;
    }
    if(confirm('Esta Seguro')){
    $.ajax({
      type:'DELETE',
      url: url+id,
      data: {id: id},
      success:function(data){
        alert('Borrado con Exito')
        $(boton).closest('tr').remove();
      },
      error:function(e){
        alert('ERROR'+e);
      }
    });
  }
}
/*ABM EDITAR USUARIO*/
function editarUsuario(persona,boton){
  var username = $("input[name=username]").val(persona.username);
  var email = $("input[name=email]").val(persona.email);
  $(".pass").hide();
  $("select[name=acceso] option[value="+ persona.acceso +"]").prop("selected",true);
  $(".btn-submit-user").hide();
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-user'>Actualizar</button>";
  $(".user-form").append(botonActualizar);
    $(".btn-put-user").click(function(e){
        e.preventDefault();
        var username=$("input[name=username]").val();
        var email =$("input[name=email]").val();
        var acceso = $("select[name=acceso]").val();
          $.ajax({
             type:'PUT',
             url:'http://localhost:8000/actualizar/usuario/'+persona.id,
             data:{username: username, email: email,acceso:acceso},
             success:function(data){
                if(data.status == 'failure'){
                alert('ERROR YA EXISTE UN REGISTRO CON EL TIPO DE EMAIL y/o USUARIO');
                $('#modalUsuario').modal('hide');
                $("input[name=username]").val("")
                $("input[name=email]").val("");
                $("input[name=password]").val("");
                $("input[name=password_confirmation]").val("");
                $("input[name=password]").show();
                $("input[name=password]_confirmation").show();
                return false;
              }
              console.log(data);
              var tpoAcceso ;
              if(data.acceso == 2){
                tipoAcceso = "Alumno";
              }else if (data.acceso == 1) {
                tipoAcceso = "Profesor";
              }else{
                tipoAcceso = "Administrador";
              }
              var tr =
              "<td id='IDregistro'>" + data.id + "</td>"+
              "<td>" + data.username + "</td>" +
              "<td>"+data.email+ "</td>" +
              "<td>"+tipoAcceso+"</td>"+
              "<td>"+
                "<div class='row'>"+
                      "<button type='button' onclick='borrarRegistro("+data.id+",this,1)' name='button' class='btn-delete btn btn-danger'>Borrar</button>"+
                      "<hr>"+
                      "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario("+data.id+",'this)'>Editar</button>"+
                "</div>"+
              "</td>"+
              $(boton).closest('tr').html(tr);
              alert('Actualizado correctamente');
              $("input[name=username]").val("");
              $("input[name=email]").val("");
              $('#modalUsuario').modal('hide');
              $(".btn-put-user").remove();
              $("btn-submit-user").show();
              $("input[name=password]").show();
              $("input[name=password]_confirmation").show();
              $("div.modal-backdrop.fade.show").remove();
             },
             error:function(e){
               alert('ERROR NO SE PUDO ACTUALIZAR'+e);
             }
          });
    });

    $("#modalUsuario").on('hidden.bs.modal', function () {
    $(".btn-put-user").remove();
    $("input[name=password]").show();
    $("input[name=password]_confirmation").show();
    $(".btn-submit-user").show();
    });

}
/*ABM AGREGAR TIPO*/
  $(".btn-submit-tipo").click(function(e){
    e.preventDefault();
    var tnombre = $("input[name=tnombre]").val();
    if(tnombre != ''){
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8000/admin/crear/tipo',
      data: {tnombre: tnombre},
      success:function(data){
        var tr = "<td>"+data.id+"</td>"+
        "<td>"+data.tipoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro({{$tipo->id}},this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar({{$tipo}},this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(".tipos tbody").append(tr);
        alert('Creado correctamente');
        $("input[name=tnombre]").val(" ");
      },
      error:function(e){
        alert('ERROR'+e)
      }
    });
  }else{
    alert('CAMPO VACIO PORFAVOR LLENE EL CAMPO');
  }
});

/*ABM EDITAR TIPO*/
function editarTipo(tipo,boton){
  document.querySelector('input[name=tnombre]').value = tipo.tipoNombre;
  $(".btn-submit-tipo").hide();
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-tipo'>Actualizar</button>";
  $(".tipo-form").append(botonActualizar);
  $(".btn-put-tipo").click(function(e){
      e.preventDefault();
      $.ajax({
      type:'PUT',
      url: 'http://localhost:8000/actualizar/tipo/'+tipo.id,
      data: {tipoNombre:$("input[name=tnombre]").val()},
      success:function(data){
        console.log(data);
        var tr = "<td>"+data.id+"</td>"+
        "<td>"+data.tipoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+ tipo.id +",this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar("+ tipo.id +",this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(boton).closest('tr').html(tr);
        alert('ACTUALIZADO CORRECTAMENTE');
        $("input[name=tnombre]").val("");
        $("#modalTipo").hide();
        $("div.modal-backdrop.fade.show").remove();
        $(".btn-put-tipo").remove();
        $(".btn-submit-tipo").show();
      },
      error:function(e){
        alert('ERROR NO SE PUDO ACTUALIZAR'+e);
      }
    })
  });
  $("#modalTipo").on('hidden.bs.modal', function () {
  $(".btn-put-tipo").remove();
  $(".btn-submit-tipo").show();
  $("input[name=tnombre]").val("");
  });

}

/*ABM AGREGAR USO*/

  $(".btn-submit-uso").click(function(e){
    e.preventDefault();
    var snombre = $("input[name=snombre]").val();
    if(snombre != ''){
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8000/admin/crear/uso',
      data: {snombre: snombre},
      success:function(data){
        var tr = "<td>"+data.id+"</td>"+
        "<td>"+data.usoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+ uso.id +",this,4)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar("+ uso.id +",this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(".usos tbody").append(tr);
        alert('Creado correctamente');
        $("input[name=snombre]").val(" ");
        $('#modalUso').modal('hide');
      },
      error:function(e){
        alert('ERROR'+e)
      }
    });
  }else{
    alert('CAMPO VACIO PORFAVOR LLENE EL CAMPO');
  }
});

/*ABM EDITAR USO*/

function editarUso(uso,boton){
  document.querySelector('input[name=snombre]').value = uso.usoNombre;
  $(".btn-submit-uso").hide();
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-uso'>Actualizar</button>";
  $(".uso-form").append(botonActualizar);
  $(".btn-put-uso").click(function(e){
      e.preventDefault();
      $.ajax({
      type:'PUT',
      url: 'http://localhost:8000/actualizar/uso/'+uso.id,
      data: {snombre:$("input[name=snombre]").val()},
      success:function(data){
        console.log(data);
        var tr = "<td>"+data.id+"</td>"+
        "<td>"+data.usoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+uso.id+",this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar("+uso.id+",this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(boton).closest('tr').html(tr);
        alert('ACTUALIZADO CORRECTAMENTE');
        $("input[name=snombre]").val("");
        $("#modalUso").hide();
        $("div.modal-backdrop.fade.show").remove();
        $(".btn-put-uso").remove();
        $(".btn-submit-uso").show();
      },
      error:function(e){
        alert('ERROR NO SE PUDO ACTUALIZAR'+e);
      }
    })
  });
  $("#modalUso").on('hidden.bs.modal', function () {
  $(".btn-put-uso").remove();
  $(".btn-submit-uso").show();
  $("input[name=snombre]").val("");
  });

}

/*CREAR LENGUAJE*/
$(".btn-submit-lenguaje").click(function(e){
  e.preventDefault();
  var nombreLenguaje = $("input[name=nlenguaje]").val();
  if(nombreLenguaje.length == null){
    alert('CAMPO VACIO')
  }else {
    $.ajax({
      type:'POST',
      url: 'http://localhost:8000/admin/crear/lenguaje',
      data: {lnombre:nombreLenguaje},
      success: function(data){
        alert('Creado con exito');
        $("#modalLenguaje").hide();
      },
      error: function(e){
        alert('ERROR '+e);
      }
    });
  }
})

function editarLenguaje(lenguaje,boton){
  $(".modal-title").text('Editar Lenguaje');
  $("input[name=nlenguaje]").val(lenguaje.nombreLenguaje);
  $(".btn-submit-lenguaje").hide();
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-lenguaje'>Actualizar</button>";
  $(".lenguaje-form").append(botonActualizar);
  $(".btn-put-lenguaje").click(function(e){
    e.preventDefault();
    var nombreLenguaje = $("input[name=nlenguaje]").val();
    if(nombreLenguaje.length == null){
      alert('CAMPO VACIO')
    }else {
      $.ajax({
        type:'PUT',
        url: 'http://localhost:8000/actualizar/lenguaje/'+lenguaje.id,
        data: {lnombre:nombreLenguaje},
        success: function(data){
          var tr = "<td>"+data.id+"</td>"+
          "<td>"+data.nombreLenguaje+"</td>"+
          "<td>"+
          "<div class='row'>"+
          "<button type='button' onclick='borrarRegistro("+data.id+",this,5)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
          "<hr>"+
          "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalLenguaje' onclick='editar("+data.id+",this)'>Editar</button>"+
          "</div>"+
          "</td>";
          $(boton).closest('tr').html(tr);
          alert('Actualizado con exito');
          $(".btn-submit-lenguaje").show();
          $(".btn-put-lenguaje").remove();
          $(".modal-title").text('Crear Lenguaje');
          $("#modalLenguaje").hide();
          $("div.modal-backdrop.fade.show").remove();
        },
        error: function(e){
          alert('ERROR '+e);
          $(".btn-submit-lenguaje").show();
          $(".btn-put-lenguaje").remove();
          $(".modal-title").text('Crear Lenguaje');
          $("#modalLenguaje").hide();
          $("div.modal-backdrop.fade.show").remove();
        }
      });
    }
  })
  $('#modalLenguaje').on('hidden.bs.modal', function () {
      $(this).find('form').trigger('reset');
      $(".btn-submit-lenguaje").show();
      $(".btn-put-lenguaje").remove();
      $(".modal-title").text('Crear Lenguaje');
    })
}


$('#modalLenguaje').on('hidden.bs.modal', function () {
      $(this).find('form').trigger('reset');
  })
/*MODALES AL CERRAR LOS CAMPOS SE LIMPIAN*/
$("#modalUso").on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
});
$("#modalTipo").on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
});
$("#modalUsuario").on('hidden.bs.modal',function(){
    $(this).find('form').trigger('reset');
});



function verPropiedades(curso,boton){
  $(".modal-title").text(curso.titulo);
  $(".descripcion-mobile").text('Descripcion:'+curso.desc);
  $(".lenguaje-mobile").text("Lenguaje: "+curso.lenguaje.nombreLenguaje);
  $(".precio-mobile").text("Precio: "+curso.precio);
  $(".uso-mobile").text('Uso: '+curso.uso.usoNombre);
  $(".tipo-mobile").text('Tipo: '+curso.tipo.tipoNombre);
  $(".autor-mobile").text('Autor: '+curso.creador.username);
  var buttonDelete = $(".delete-mobile");
  var buttonEdit = $(".edit-mobile");
  var button = document.querySelector('button.delete-mobile');
  console.log(button);
  console.log(boton);
  buttonDelete.attr('onclick',"borrarRegistro("+curso.id+",this,2)");
  buttonEdit.attr('href','/editar/curso/'+curso.id);

}





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
  }else{
    return 0;
  }/*
  1-CAMPOS VACIOS
  2-LA CONTRASEÑA DEBE SER MAYOR A 8
  3-LAS CONTRASEÑAS DEBEN SER IGUALES
  4-EL EMAIL DEBE CONTENER UN @
  0-TODO OK
  */
}
/*
  window.addEventListener("load", function() {
    if(window.innerWidth <= 425 ){
      alert('ATENCION, PARA UNA MEJOR EXPERIENCIA EN EL ABM SE RECOMIENDA UTILIZAR UNA COMPUTADORA');
    }
  });*/
