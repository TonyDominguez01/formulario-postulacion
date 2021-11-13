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