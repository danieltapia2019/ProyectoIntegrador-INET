$(function(){
    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
        }
    })
    $(document).on('click','.activar',function(e){
        e.preventDefault();
        let element=$(this)[0];
        let url=$(element).attr("href");

        $.post(url,function(response){
            console.log(response.cursos)
            alert(response.cursos);

        }).fail(function(){
            console.log("esto no funca")
        })
    })







});
