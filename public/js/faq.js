//Ocultar Registrar
$(".registarse").click(function(e){
  alert('HIZO REGISTER');
  if($(".register").show()){
    $(".register").hide()
  }else{
    $(".register").show()
  }
})
