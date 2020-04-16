

function ocultar() {
    // var form = document.querySelector('form.filt-form');
    var divForm = document.querySelector('div.filt-form');

    (divForm.getAttribute('hidden') != null)? divForm.removeAttribute('hidden') : divForm.setAttribute('hidden','') ;
}

function filterSearch() {
    // var btnBusq = document.querySelector('button#botonBusq');
    var tipo = document.getElementById('tipo');
    var valTipo = tipo.options[tipo.selectedIndex].value;

    var uso = document.getElementById('uso');
    var valUso = uso.options[uso.selectedIndex].value;

    // console.log(valTipo,valUso);
    // console.log(typeof valUso);
    var aux = "";

    if( (valTipo === 'all') && (valUso === 'all') ){
        console.log('1 if');
        console.log(valTipo,valUso);
        aux = "0";
    } else if( (valTipo !== 'all') && (valUso === 'all') ){
        console.log('2 if');
        console.log(valTipo,valUso);
        aux = "1";
    } else if( (valTipo === 'all') && (valUso != 'all') ){
        console.log('3 if');
        console.log(valTipo,valUso);
        aux = "2";
    } else{
        console.log('4 if');
        console.log(valTipo,valUso);
        aux = "3";
    }
   
    var iptHidden = document.createElement("input");

    iptHidden.setAttribute('name',"valState");
    iptHidden.setAttribute('value',aux);
    iptHidden.setAttribute('hidden',true);

    $('form#filtForm').submit();
}