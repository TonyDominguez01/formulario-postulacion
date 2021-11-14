let estadoMenu = false;

const MostrarOcultarMenu = () => {
    let padre = document.getElementById('nav');
    let enlaces = padre.getElementsByClassName('link');
    for (let i = 0; i < enlaces.length; i++) {
        if (estadoMenu) enlaces[i].classList.remove("mostrar-menu");
        else enlaces[i].classList.add("mostrar-menu");
    }
    estadoMenu = !estadoMenu;
}

const CambiarActivo = (e) => {
    if (!e.target.classList.contains('activo')){
        let elementos = document.getElementsByClassName('activo');
        for (let i = 0; i < elementos.length; i++) {
            elementos[i].classList.remove('activo');
        }
        e.target.classList.add('activo');
    }
}