const VerificarDatos = () => {
    let telefono01 = document.getElementById('telefono01');
    let email01 = document.getElementById('email01');
    let curp = document.getElementById('curp');
    let ine = document.getElementById('ine');

    let error = '';

    if (telefono01.length == 10) { error += 'Error en el teléfono'; }
    if (curp.length == 18) { error += 'Error en el curp'; }
    if (ine.length == 18) { error += 'Error en el ine'; }

    if (error.length <= 0) {
        
    }
}
const Check = (e) => {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

const activarModal = () => {
    document.getElementById('btn-horario').classList.toggle('active');
    document.getElementById('btn-modal').classList.toggle('active');
}
const validacion = () => {
    if (document.getElementById('avisoPrivacidad').checked == false) {
        alert('Debes leer y aceptar el aviso de privacidad antes de continuar')
        document.getElementById('avisoPrivacidad').focus();
        return false
    }
    return true;
}