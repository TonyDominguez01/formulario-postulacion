let solicitudSeleccionada = '';
let estadoToggle = true;

const abrirBorrar = (id, nombre) => {
    solicitudSeleccionada = id;
    document.getElementById('modal-borrar').classList.toggle('active');
    document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
    document.getElementById('txt-borrar').innerHTML = '¿Estás seguro que quieres eliminar la solicitud ' + id + ' de ' + nombre + '?';
}
const cerrarBorrar = () => {
    document.getElementById('modal-borrar').classList.toggle('active');
    document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
}

const borrarSolicitud = () => {
    location.href = './php/borrarSolicitud?id=' + solicitudSeleccionada;
}

const enviarWhatsapp = (telefono) => {
    window.open('https://api.whatsapp.com/send?phone=+52' + telefono, '_blank');
}

const cambiarFiltro = () => {
    estadoToggle = !estadoToggle;
    if (estadoToggle) {
        document.getElementById('toggle-filtro-l').classList.add('active');
        document.getElementById('toggle-filtro-r').classList.remove('active');
        document.getElementById('form-buscar').classList.add('active');
        document.getElementById('form-filtrar').classList.remove('active');
    }
    else {
        document.getElementById('toggle-filtro-r').classList.add('active');
        document.getElementById('toggle-filtro-l').classList.remove('active');
        document.getElementById('form-filtrar').classList.add('active');
        document.getElementById('form-buscar').classList.remove('active');
    }
}

const ordenarPorNombre = () => {
    document.getElementById('toggle-ordenar-l').classList.add('active');
    document.getElementById('toggle-ordenar-r').classList.remove('active');
}
const ordenarPorFecha = () => {
    document.getElementById('toggle-ordenar-r').classList.add('active');
    document.getElementById('toggle-ordenar-l').classList.remove('active');
}
const ordenarDescendente = () => {
    document.getElementById('toggle-sentido-l').classList.add('active');
    document.getElementById('toggle-sentido-r').classList.remove('active');
}
const ordenarAscendente = () => {
    document.getElementById('toggle-sentido-r').classList.add('active');
    document.getElementById('toggle-sentido-l').classList.remove('active');
}
const mostrarBuscar = () => {
    document.getElementById('toggle-filtro-l').classList.add('active');
    document.getElementById('toggle-filtro-r').classList.remove('active');
    document.getElementById('form-buscar').classList.add('active');
    document.getElementById('form-filtrar').classList.remove('active');
}
const mostrarFiltrar = () => {
    document.getElementById('toggle-filtro-r').classList.add('active');
    document.getElementById('toggle-filtro-l').classList.remove('active');
    document.getElementById('form-filtrar').classList.add('active');
    document.getElementById('form-buscar').classList.remove('active');
}
const actualizarBuscar = (rows, busqueda) => {
    mostrarBuscar();
    document.getElementById('results').innerHTML = '<b>'+rows+'</b> solicitude(s) encontrada(s) de la busqueda <b>'+busqueda+'</b>';
}
const actualizarFiltrar = (rows, inicio, final) => {
    mostrarFiltrar();
    document.getElementById('results').innerHTML = '<b>'+rows+'</b> solicitude(s) recibida(s) entre el <b>'+inicio+'</b> y el <b>'+final+'</b>';
}