estadoPassword = false;

const mostrarOcultar = () => {
    if (estadoPassword) {
        document.getElementById('ocultar-password').firstChild.setAttribute('src', './icons/icon_hide.png');
        document.getElementById('password').setAttribute('type', 'password');
    }
    else {
        document.getElementById('ocultar-password').firstChild.setAttribute('src', './icons/icon_show.png');
        document.getElementById('password').setAttribute('type', 'text');
    }
    estadoPassword = !estadoPassword;
}
const mostrarOcultarPlace = () => {
    mostrarOcultar();
    if (estadoPassword) {
        document.getElementById('password').setAttribute('placeholder', 'password');
    }
    else {
        document.getElementById('password').setAttribute('placeholder', '••••••••');
    }
}