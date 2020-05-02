
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
  $(".modal-title").text('Crear Usuario');
  $(".btn-submit-user").show();
})
$(".btn-submit-user").click(function(e){
  e.preventDefault();
  var username = $("input[name=username]").val();
  var email = $("input[name=email]").val();
  var password = $("input[name=password]").val();
  var acceso = $("select[name=acceso]").val();
  var campos = validarCamposUsuario(username,email,password,$("input[name=password_confirmation]").val());
  switch (campos) {
    case 1: alerta('Campos Vacios!','Por favor llene los campos requeridos ','red')
    case 2: alerta('Contraseña','La contraseña como minimo necesita un total de 8 caracteres','red');break;
    case 3: alerta('Contraseñas no coinciden','Las contraseñas no coinciden','red');break;
    case 4: alerta('Email','El email no utiliza el simbolo @' ,'red');break;
    case 5: alerta('Error de Longitud','Los campos nombre de usuario y contraseña necesitan un tamaño minimo mayor a 5 y 10 o un tamaño maximo de 25 y 40 respectivamente','red');break;
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
                alerta('Error en el servidor!','Ya existe un registro con el email y/o nombre de usuario ','red')
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
                    "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario("+JSON.stringify(data)+",this'>Editar</button>"+
              "</div>"+
            "</tr>";
            $(".usuarios tbody").append(tr_str);
            alerta('Creado correctamente!','El registro usuario ha sido creado correctamente','green');
            $("input[name=username]").val("");
            $("input[name=email]").val("");
            $("input[name=password]").val("");
            $("input[name=password_confirmation]").val("");
            $('#modalUsuario').modal('hide');
           },
           error:function(e){
             alerta('Error en el servidor!','A ocurrido un error al crear un usuario y el error es '+e,'red')
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
    $.confirm({
    title: 'Eliminar Registro!',
    content: '¿Esta seguro que dese eliminar el registro?',
    columnClass: 'col-md-12',
    type: 'red',
    typeAnimated: true,
    buttons: {
        confirmar: function () {
        $.ajax({
          type:'DELETE',
          url: url+id,
          data: {id: id},
          success:function(data){
          $.alert({
          title: 'Borrado con Exito!',
          content: 'El registro ha sido borrado correctamente',
          type: 'green',
          typeAnimated: true,
          columnClass: 'col-md-12',
          offsetTop: 0,
          });
          $(boton).closest('tr').remove();
          },
          error:function(e){
          $.alert({
          title: 'Error!',
          content: 'El registro no ha podido ser eliminado, el error es '+e,
          type: 'red',
          typeAnimated: true,
          });
          }
        });
        },
        cancelar:
        function () {
        },
    }
    });
}
/*ABM EDITAR USUARIO*/
function editarUsuario(persona,boton){
  var username = $("input[name=username]").val(persona.username);
  var email = $("input[name=email]").val(persona.email);
  $(".modal-pass").hide();
  $(".modal-pass-confirm").hide();
  $(".modal-title").text('Editar Usuario');
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-user'>Actualizar</button>";
  $(".btn-submit-user").hide();
  $(".user-form").append(botonActualizar);
  $("select[name=acceso] option[value="+ persona.acceso +"]").prop("selected",true);

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
                  alerta('Error en el servidor!','Ya existe un registro con el email y/o nombre de usuario ','red')
                $('#modalUsuario').modal('hide');
                $("input[name=username]").val("")
                $("input[name=email]").val("");
                $("input[name=password]").val("");
                $("input[name=password_confirmation]").val("");
                $("input[name=password]").show();
                $("input[name=password]_confirmation").show();
                $(".btn-put-user").remove();
                $("btn-submit-user").show();
                $(".modal-pass").show();
                $(".modal-pass-confirm").show();
                $("div.modal-backdrop.fade.show").remove();
                return false;
              }
              console.log(data);
              var tpoAcceso;
              var imagen;
              if(data.acceso == 2){
                tipoAcceso = "Alumno";
              }else if (data.acceso == 1) {
                tipoAcceso = "Profesor";
              }else{
                tipoAcceso = "Administrador";
              }
              if(data.foto == null){
                imagen = "Nulo";
              }else{
                imagen = "<a href='/storage/img/avatar/"+data.foto+"'>  </a>"
              }
              var tr =
              "<td id='abmUser' class='table-success'>" + data.id + "</td>"+
              "<td class='table-success'>" + data.username + "</td>" +
              "<td id='abmUser' class='table-success'>"+data.email+ "</td>" +
              "<td id='abmUser' class='table-success'>"+tipoAcceso+"</td>"+
              "<td id='abmUser' class='table-success'>"+imagen+ "</td>" +
              "<td id='abmUser' class='table-success'>"+
                "<div class='row'>"+
                      "<button type='button' onclick='borrarRegistro("+data.id+",this,1)' name='button' class='btn-delete btn btn-danger'>Borrar</button>"+
                      "<hr>"+
                      "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUsuario' onclick='editarUsuario("+JSON.stringify(data)+",'this)'>Editar</button>"+
                "</div>"+
              "</td>";
              $(boton).closest('tr').html(tr);
              alerta('Actualizado correctamente!','El registro ha sido actualizado correctamente','green');
              $("input[name=username]").val("");
              $("input[name=email]").val("");
              $('#modalUsuario').modal('hide');
              $(".btn-put-user").remove();
              $(".btn-submit-user").show();
              $(".modal-pass").show();
              $(".modal-pass-confirm").show();
              $("div.modal-backdrop.fade.show").remove();
             },
             error:function(e){
               alerta('Error en el servidor!','A ocurrido un error al actualizar y el error es '+e,'red')
             }
          });
    });

    $("#modalUsuario").on('hidden.bs.modal', function () {
    $(".btn-put-user").remove();
    $(".modal-pass").show();
    $(".modal-pass-confirm").show();
    });

}
/*ABM AGREGAR TIPO*/
  $(".btn-agregar-tipo").click(function(e){
    $(".modal-title").text('Agregar Tipo')
  })
  $(".btn-submit-tipo").click(function(e){
    e.preventDefault();
    var tnombre = $("input[name=tnombre]").val();
    var campo;
    switch (validarCamposNombres(tnombre)) {
      case 0:
      campo=0;
      break;
      case 1:
      alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 4 y un tamaño maximo de 25','red')
      break;
      case 2:
      alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
      break;
    }
    if(campo==0){
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8000/admin/crear/tipo',
      data: {tnombre: tnombre},
      success:function(data){
        var tr =
        "<tr>"+
        "<td>"+data.id+"</td>"+
        "<td>"+data.tipoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+ data.id+",this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalTipo' onclick='editarTipo("+ JSON.stringify(data) +",this)'>Editar</button>"+
        "</div>"+
        "</td>"+
        "</tr>";
        $(".tipos tbody").append(tr);
        alerta('Creado correctamente!','El registro tipo ha sido creado correctamente','green');
      $('#modalTipo').modal('hide');
      $("div.modal-backdrop.fade.show").remove();
      $("input[name=tnombre]").val(" ");
      },
      error:function(e){
        alerta('Error en el servidor!','A ocurrido un error al crear y el error es '+e,'red')
      }
    });
    }
});

/*ABM EDITAR TIPO*/
function editarTipo(tipo,boton){
  document.querySelector('input[name=tnombre]').value = tipo.tipoNombre;
  $(".btn-submit-tipo").hide();
  $(".modal-title").text('Editar Tipo');
  var botonActualizar ="<button type='submit' class='btn btn-warning btn-block my-3 btn-put-tipo'>Actualizar</button>";
  $(".tipo-form").append(botonActualizar);
  $(".btn-put-tipo").click(function(e){
  var campo;
  switch (validarCamposNombres($("input[name=tnombre]").val() )) {
    case 0:
    campo=0;
    break;
    case 1:
    alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 4 y un tamaño maximo de 25','red')
    break;
    case 2:
    alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
    break;
  }
  if(campo==0){
      e.preventDefault();
      $.ajax({
      type:'PUT',
      url: 'http://localhost:8000/actualizar/tipo/'+tipo.id,
      data: {tipoNombre:$("input[name=tnombre]").val()},
      success:function(data){
        var tr = "<td class='table-success'>"+data.id+"</td>"+
        "<td class='table-success'>"+data.tipoNombre+"</td>"+
        "<td class='table-success'>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+ tipo.id +",this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalTipo' onclick='editarTipo("+ JSON.stringify(data) +",this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(boton).closest('tr').html(tr);
        alerta('Actualizado Correctamente!','El registro tipo ha sido actualizado correctamente','green');
        $("input[name=tnombre]").val("");
        $("#modalTipo").hide();
        $("div.modal-backdrop.fade.show").remove();
        $(".btn-put-tipo").remove();
        $(".btn-submit-tipo").show();
      },
      error:function(e){
        alerta('Error en el servidor!','A ocurrido un error al actualizar y el error es '+e,'red')
      }
    })
    }
  });
  $("#modalTipo").on('hidden.bs.modal', function () {
  $(".btn-put-tipo").remove();
  $(".btn-submit-tipo").show();
  $(this).find('form').trigger('reset');
  });

}

/*ABM AGREGAR USO*/

  $(".btn-submit-uso").click(function(e){
    e.preventDefault();
    var snombre = $("input[name=snombre]").val();
    var campo;
    switch (validarCamposNombres(snombre)) {
      case 0:
      campo=0;
      break;
      case 1:
      alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 4 y un tamaño maximo de 25','red')
      break;
      case 2:
      alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
      break;
    }
    if(campo==0){
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8000/admin/crear/uso',
      data: {snombre: snombre},
      success:function(data){
        var tr =
        "<tr>"
        "<td>"+data.id+"</td>"+
        "<td>"+data.usoNombre+"</td>"+
        "<td>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+ uso.id +",this,4)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editarUso("+ JSON.stringify(data) +",this)'>Editar</button>"+
        "</div>"+
        "</td>"+
        "</tr>";
        $(".usos tbody").append(tr);
        alerta('Creado correctamente','El registro uso ha sido creado correctamente','green');
        $("input[name=snombre]").val(" ");
        $("#modalUso").hide();
        $("div.modal-backdrop.fade.show").remove();
      },
      error:function(e){
      alerta('Error en el servidor!','A ocurrido un error al crear un registro y el error es '+e,'red')
      $("#modalUso").hide();
      $("div.modal-backdrop.fade.show").remove();
      }
    });
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
      var campo;
      switch (validarCamposNombres($("input[name=snombre]").val())) {
        case 0:
        campo=0;
        break;
        case 1:
        alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 4 y un tamaño maximo de 25','red')
        break;
        case 2:
        alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
        break;
      }
      if(campo==0){
      $.ajax({
      type:'PUT',
      url: 'http://localhost:8000/actualizar/uso/'+uso.id,
      data: {snombre:$("input[name=snombre]").val()},
      success:function(data){
        console.log(data);
        var tr = "<td class='table-success'>"+data.id+"</td>"+
        "<td class='table-success'>"+data.usoNombre+"</td>"+
        "<td class='table-success'>"+
        "<div class='row'>"+
        "<button type='button' onclick='borrarRegistro("+uso.id+",this,3)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
        "<hr>"+
        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalUso' onclick='editarUso("+JSON.stringify(data)+",this)'>Editar</button>"+
        "</div>"+
        "</td>";
        $(boton).closest('tr').html(tr);
        alerta('Actualizado Correctamente!','El registro editar curso ha sido actualizado correctamente ','green');
        $("input[name=snombre]").val("");
        $("#modalUso").hide();
        $("div.modal-backdrop.fade.show").remove();
        $(".btn-put-uso").remove();
        $(".btn-submit-uso").show();
      },
      error:function(e){
        alerta('Error en el servidor!','A ocurrido un error al actualizar y el error es '+e,'red')
        $("#modalUso").hide();
        $("div.modal-backdrop.fade.show").remove();
      }
    })
    }
  });
  $("#modalUso").on('hidden.bs.modal', function () {
  $(".btn-put-uso").remove();
  $(".btn-submit-uso").show();
  $(this).find('form').trigger('reset');
  });

}

/*CREAR LENGUAJE*/
$(".btn-submit-lenguaje").click(function(e){
  e.preventDefault();
  var nombreLenguaje = $("input[name=nlenguaje]").val();
  var campo;
  switch (validarCamposLenguajes(nombreLenguaje)) {
    case 0:
    campo=0;
    break;
    case 1:
    alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 4 y un tamaño maximo de 25','red')
    break;
    case 2:
    alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
    break;
  }
  if(campo==0){
    $.ajax({
      type:'POST',
      url: 'http://localhost:8000/admin/crear/lenguaje',
      data: {lnombre:nombreLenguaje},
      success: function(data){
        var tr =
          "<tr>"+
          "<td class='table-success'>"+data.id+"</td>"+
          "<td class='table-success'>"+data.nombreLenguaje+"</td>"+
          "<td class='table-success'>"+
          "<div class='row'>"+
          "<button type='button' onclick='borrarRegistro("+data.id+",this,5)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
          "<hr>"+
          "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalLenguaje' onclick='editarLenguaje("+JSON.stringify(data)+",this)'>Editar</button>"+
          "</div>"+
          "</td>"+
          "</tr>";
        $(".table tbody").append(tr);
        alerta('Creado correctamente!','El lenguaje fue creado correctamente','green');
        $("#modalLenguaje").hide();
        $("div.modal-backdrop.fade.show").remove();
        $("body").removeAttr('class');
      },
      error: function(e){
        alerta('Error en el servidor!','A ocurrido un error al crear un Lenguaje y el error es '+e,'red');
        $("#modalLenguaje").hide();
        $("div.modal-backdrop.fade.show").remove();
        $("body").removeAttr('class');
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
    var campo;
    switch (validarCamposLenguajes(nombreLenguaje)) {
      case 0:
      campo=0;
      break;
      case 1:
      alerta('Tamaño Incorrecto!','El campo nombre necesita un tamaño minimo de 1 y un tamaño maximo de 25','red')
      break;
      case 2:
      alerta('Nombre Incorrecto!','El campo nombre necesita ser de tipo string','red')
      break;
    }
    if(campo==0){
      $.ajax({
        type:'PUT',
        url: 'http://localhost:8000/actualizar/lenguaje/'+lenguaje.id,
        data: {lnombre:nombreLenguaje},
        success: function(data){
          var tr = "<td class='table-success'>"+data.id+"</td>"+
          "<td class='table-success'>"+data.nombreLenguaje+"</td>"+
          "<td class='table-success'>"+
          "<div class='row'>"+
          "<button type='button' onclick='borrarRegistro("+data.id+",this,5)' name='button' class='btn-delete btn btn-danger'>Eliminar</button>"+
          "<hr>"+
          "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalLenguaje' onclick='editarLenguaje("+JSON.stringify(data)+",this)'>Editar</button>"+
          "</div>"+
          "</td>";
          $(boton).closest('tr').html(tr);
          alerta('Actualizado con exito!','El registro lenguaje ha sido actualizado con exito','green');
          $(".btn-submit-lenguaje").show();
          $(".btn-put-lenguaje").remove();
          $(".modal-title").text('Crear Lenguaje');
          $("#modalLenguaje").hide();
          $("div.modal-backdrop.fade.show").remove();
          $("body").removeAttr('class');
        },
        error: function(e){
          alerta('Error en el servidor!','A ocurrido un error al actualizar y el error es '+e,'red');
          $(".btn-submit-lenguaje").show();
          $(".btn-put-lenguaje").remove();
          $(".modal-title").text('Crear Lenguaje');
          $("#modalLenguaje").hide();
          $("div.modal-backdrop.fade.show").remove();
          $("#modalLenguaje").find('form').trigger('reset');
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

//SOLO MOBILE

function verPropiedades(curso,boton){
  $(".modal-title").text(curso.titulo);
  $(".descripcion-mobile").text('Descripcion:'+curso.desc);
  $(".lenguaje-mobile").text("Lenguaje: "+curso.lenguaje.nombreLenguaje);
  $(".precio-mobile").text("Precio: "+curso.precio);
  $(".uso-mobile").text('Uso: '+curso.uso.usoNombre);
  $(".tipo-mobile").text('Tipo: '+curso.tipo.tipoNombre);
  $(".autor-mobile").text('Autor: '+curso.creador.username);
  var imagenLink = "<a href='/storage/img/cursos/"+curso.foto_curso +"'>Ver Imagen</a>"
  $(".imagen-mobile").html(imagenLink);
  var alumnosLink = "<a href='/alumnos/curso/"+curso.id +"'>Alumnos</a>";
  $(".alumnos-mobile").html(alumnosLink);
  var buttonDelete = $(".delete-mobile");
  var buttonEdit = $(".edit-mobile");
  var button = document.querySelector('button.delete-mobile');
  console.log(button);
  console.log(boton);
  buttonDelete.attr('onclick',"borrarRegistro("+curso.id+",this,2)");
  buttonEdit.attr('href','/editar/curso/'+curso.id);

}
function verTransaccion(transaccion,boton){
  var estado;
  var btnHabilitar = $(".btn-habilitar");
  $(".modal-title").text('Referencia: '+ transaccion.referencia);
  $(".username-mobile").text('Usuario: '+transaccion.usuario.username);
  $(".cursotitle-mobile").text("Lenguaje: "+transaccion.curso.titulo);
  if(transaccion.estado == 1){
    estado = "Pagado"
    btnHabilitar.attr('disabled','true')
    btnHabilitar.text('Habilitar')
    btnHabilitar.attr('class','btn btn-danger')
  }else{
    estado = "En proceso"
    btnHabilitar.attr('href', 'http://localhost:8000/activar/'+ transaccion.id)
    btnHabilitar.attr('tranId',transaccion.id)
    btnHabilitar.text('Habilitar')
    btnHabilitar.attr('class','btn btn-success activar')
    btnHabilitar.removeAttr('disabled')
  }
  $(".state-mobile").text("Estado: "+estado);
  $(".activar").click(function(e){
    $("#modalTransaccion").hide();
    $("div.modal-backdrop.fade.show").remove();
  })
}

function alerta(titulo,contenido,tipo){
  $.alert({
  title: titulo,
  content: contenido,
  type: tipo,
  typeAnimated: true,
  columnClass: 'col-md-12',
  offsetTop: 0,
  });
}
$("#logoHOME").mouseover(function(){
  var ancho = $(this).width();
  var alto = $(this).height();
  $(this).width(ancho+20);
  $(this).height(alto+20);
})

$("#logoHOME").mouseout(function(){
  var ancho = $(this).width();
  var alto = $(this).height();
  $(this).width(ancho-20);
  $(this).height(alto-20);
})
  window.addEventListener("load", function() {
    if(window.innerWidth <= 425 ){
      alert('ATENCION, PARA UNA MEJOR EXPERIENCIA EN EL ABM SE RECOMIENDA UTILIZAR UNA COMPUTADORA');
    }
  });
