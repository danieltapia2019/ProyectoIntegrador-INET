
/*ABM CREAR USUARIO*/
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
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
                    "<button type='button' onclick='borrarRegistro({{$alumno->id}},this,1)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
                    "<hr>"+
                    "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario({{$alumno}},this)'>Editar</button>"+
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
  var password = $("input[name=password]").val();
  $("select[name=acceso] option[value="+ persona.acceso +"]").prop("selected",true);
  $(".btn-submit-user").hide();
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-user'>Actualizar</button>";
  $(".user-form").append(botonActualizar);
    $(".btn-put-user").click(function(e){
        e.preventDefault();
        var campos = validarCamposUsuario($("input[name=username]").val(),$("input[name=email]").val(),$("input[name=password]").val(),$("input[name=password_confirmation]").val());
        switch (campos) {
          case 1: alert('HAY CAMPOS VACIOS');break;
          case 2: alert('LA CONTRASEÑA TIENE QUE TENER MINIMO 8 CARACTERES');break;
          case 3: alert('LA CONTRASEÑAS NO COINCIDEN');break;
          case 4: alert('EL EMAIL NO UTILIZA @');break;
            break;
          default:
        }
        if(campos==0){

          $.ajax({
             type:'PUT',
             url:'http://localhost:8000/actualizar/usuario/'+persona.id,
             data:{username: $("input[name=username]").val(), email:$("input[name=email]").val(), password:$("input[name=password]").val(),acceso:$("select[name=acceso]").val()},
             success:function(data){
                if(data.status == 'failure'){
                alert('ERROR YA EXISTE UN REGISTRO CON EL TIPO DE EMAIL y/o USUARIO');
                $('#modalUsuario').modal('hide');
                $("input[name=username]").val("")
                $("input[name=email]").val("");
                $("input[name=password]").val("");
                $("input[name=password_confirmation]").val("");
                return false;
              }
              console.log(data);
              var tr =
              "<tr>"+
              "<td>" + data.id + "</td>"+
              "<td>" + data.username + "</td>" +
              "<td>"+data.email+ "</td>" +
              "<td>"+
                "<div class='row'>"+
                      "<button type='button' onclick='borrarRegistro({{$alumno->id}},this,1)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
                      "<hr>"+
                      "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario({{$alumno}},this)'>Editar</button>"+
                "</div>"+
              "</td>"+
              "</tr>";
              $(boton).closest('tr').html(tr);
              alert('Actualizado correctamente');
              $("input[name=username]").val("");
              $("input[name=email]").val("");
              $("input[name=password]").val("");
              $("input[name=password_confirmation]").val("");
              $('#modalUsuario').modal('hide');
              $(".btn-put-user").remove();
              $("btn-submit-user").show();
              $("div.modal-backdrop.fade.show").remove();
             },
             error:function(e){
               alert('ERROR NO SE PUDO ACTUALIZAR'+e);
             }
          });
        }
    });

    $("#modalUsuario").on('hidden.bs.modal', function () {
    $(".btn-put-user").remove();
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
        "<button type='button' onclick='borrarRegistro({{$tipo->id}},this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar({{$tipo}},this)'>Editar</button>"+
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
        "<button type='button' onclick='borrarRegistro({{$uso->id}},this,4)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar({{$tipo}},this)'>Editar</button>"+
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
        "<button type='button' onclick='borrarRegistro({{$uso->id}},this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editar({{$uso}},this)'>Editar</button>"+
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
/*MODALES AL CERRAR LOS CAMPOS SE LIMPIAN*/
$("#modalUso").on('hidden.bs.modal', function () {
$("input[name=snombre]").val("");
});
$("#modalTipo").on('hidden.bs.modal', function () {
$("input[name=tnombre]").val("");
});
$("#modalUsuario").on('hidden.bs.modal',function(){
$("input[name=username]").val("");
$("input[name=email]").val("");
$("input[name=password]").val("");
$("input[name=password_confirmation]").val("");
});










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
