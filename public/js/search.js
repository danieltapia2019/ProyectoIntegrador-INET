function ocultar() {
    // let form = document.querySelector('form.filt-form');
    let divForm = document.querySelector('div.filt-form');

    (divForm.getAttribute('hidden') != null) ? divForm.removeAttribute('hidden'): divForm.setAttribute('hidden', '');
}

function filterSearch() {
    //Obtengo los valores de los inputs
    var tipo = document.getElementById('tipo');
    let valTipo = tipo.options[tipo.selectedIndex].value;

    var uso = document.getElementById('uso');
    let valUso = uso.options[uso.selectedIndex].value;

    var lng = document.getElementById('lenguaje');
    let valLng = lng.options[lng.selectedIndex].value;

    var time = document.getElementById('orden');
    let valTime = time.options[time.selectedIndex].value;


    //Devuelvo un 'estado' para la funcion del controlador
    let aux = statusInput(valTipo, valUso, valLng);
    let auxTime = statusTimeInput(valTime);

    //creo dos inputs que le enviaran la informacion extra al controlador
    let iptHidden = document.createElement("input");

    iptHidden.setAttribute('name', "state");
    iptHidden.setAttribute('value', aux);
    iptHidden.setAttribute('hidden', true);

    let iptTimeHidden = document.createElement("input");

    iptTimeHidden.setAttribute('name', "setTime");
    iptTimeHidden.setAttribute('value', auxTime);
    iptTimeHidden.setAttribute('hidden', true);

    //Agrego los inputs al formulario
    let form = document.querySelector('form#filtForm');
    form.appendChild(iptHidden);
    form.appendChild(iptTimeHidden);

    //Activo el evento submit del formulario
    $('form#filtForm').submit();
}


function statusInput(tipo, uso, lng) {
    if ( (tipo === 'all') && (uso === 'all') && (lng === 'all') ) {
        console.log('1 if');
        console.log(tipo, uso, lng);
        return "0";
    } else if ( (tipo !== 'all') && (uso === 'all') && (lng === 'all') ) {
        console.log('2 if');
        console.log(tipo, uso, lng);
        return "1";
    } else if ( (tipo === 'all') && (uso !== 'all') && (lng === 'all') ) {
        console.log('3 if');
        console.log(tipo, uso, lng);
        return "2";
    } else if ( (tipo === 'all') && (uso === 'all') && (lng !== 'all') ) {
        console.log('4 if');
        console.log(tipo, uso, lng);
        return "3";
    } else if ( (tipo !== 'all') && (uso !== 'all') && (lng === 'all') ) {
        console.log('5 if');
        console.log(tipo, uso, lng);
        return "4";
    } else if ( (tipo === 'all') && (uso !== 'all') && (lng !== 'all') ) {
        console.log('6 if');
        console.log(tipo, uso, lng);
        return "5";
    } else if ( (tipo !== 'all') && (uso === 'all') && (lng !== 'all') ) {
        console.log('7 if');
        console.log(tipo, uso, lng);
        return "6";
    } else {
        console.log('8 if');
        console.log(tipo, uso, lng);
        return "7";
    }
}

function statusTimeInput(time) {
    if (time === 'all') {
        return "d";
    } else if (time === 'new') {
        return "n";
    } else if (time === 'old') {
        return "o";
    }
}