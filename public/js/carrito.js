$(function () {
    //Para cada consulta se necesita el token por eso lo configuramos de entrada para no ponerlo en todas las peticiones
    console.log("hoolaaa")
    var total = $("#total").attr("value");
    console.log(total)
    if (total > 0) {
        $("#vacio1").css("display", "none")
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    })
    $(document).on('click', '.agregar', function () {
        let element = $(this)[0];
        let id = $(element).attr("cursoId");
        var url = $(element).attr("href");
        $.post(url, function (response) {

            alert(response.mensaje)
        }).fail(function () {
            console.log("esto no funciona")
        })
    })

    //codigo para borrar del carrito elementos
    $(document).on('click', '.borrar-uno', function (e) {
        e.preventDefault();
        let element = $(this)[0];
        let url = $(element).attr("href");
        let padre = $(this)[0].parentElement;
        let id = $(element).attr("cursoId");
        let precio = $("p[cursoId=" + id + "]")[0];
        //
        $(padre).animate({
            opacity: 0
        }, "slow").hide(500, function () {
            $(this).remove();
        });
        $(precio).animate({
            opacity: 0
        }, "slow").hide(500, function () {
            $(this).remove();
        });
        $.post(url, function (response) {
            console.log(response.mensaje)
            total -= response.precio
            if (total == 0) {
                $("#lleno").css("display", "none");
                $("#vacio1").css("display", "block")

            }
            $("#total").html("$" + total)

        }).fail(function () {
            console.log("esto no funca")
        })
    })
});
