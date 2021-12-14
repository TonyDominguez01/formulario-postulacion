let usuarioSeleccionado = '';

const abrirBorrar = (correo) => {
    usuarioSeleccionado = correo;
    document.getElementById('modal-borrar').classList.toggle('active');
    document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
    document.getElementById('txt-borrar').innerHTML = '¿Estás seguro que quieres eliminar al usuario con correo ' + correo + '?';
}
const cerrarBorrar = () => {
    document.getElementById('modal-borrar').classList.toggle('active');
    document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
}
const borrarUsuario = () => {
    location.href = './?peticion=borrar-usuario&correo=' + usuarioSeleccionado;
}