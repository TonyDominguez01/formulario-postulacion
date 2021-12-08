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
