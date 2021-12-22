const setMessage = (e) => {
    e.setCustomValidity('');
    if(!e.checkValidity()) {
        let mensaje = '';
        switch (e.id) {
            case 'cp': mensaje = 'Debe estar formado por 5 números'; break;
            case 'telefono01': mensaje = 'Debe estar formado por 10 números'; break;
            case 'telefono02': mensaje = 'Debe estar formado por 10 números'; break;
            case 'curp': mensaje = 'Debe estar formado por 18 carácteres alfanuméricos'; break;
            case 'rfc': mensaje = 'Debe estar formado por 13 carácteres alfanuméricos'; break;
            case 'nss': mensaje = 'Debe estar formado por 11 números'; break;
            case 'ine': mensaje = 'Debe estar formado por 18 carácteres alfanuméricos'; break;
            default: break;
        }
        e.setCustomValidity(mensaje);
    }
}

const activarModal = () => {
    document.getElementById('btn-horario').classList.toggle('active');
    document.getElementById('btn-modal').classList.toggle('active');
}
const validacion = () => {
    if (document.getElementById('avisoPrivacidad').checked == false) {
        alert('Debes leer y aceptar el aviso de privacidad antes de continuar');
        document.getElementById('avisoPrivacidad').focus();
        return false
    }
    return true;
}
