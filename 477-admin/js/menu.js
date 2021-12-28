const MostrarOcultarMenuM = () => {
    let padre = document.getElementById('nav');
    let enlaces = padre.getElementsByClassName('link');
    for (let i = 0; i < enlaces.length; i++) {
        enlaces[i].classList.toggle("mostrar-menu");
    }
    document.getElementById('encabezado').classList.toggle("mostrar-menu");
    document.getElementById('menu').classList.toggle("mostrar-menu");
    document.getElementById('contenedor').classList.toggle("mostrar-menu");
}