<?php
    function verificarActividad (){
        if (isset($_SESSION['ultimoAcceso'])) {
            $tiempoActual = date("Y-n-j H:i:s");
            $tiempoInactividad = 900;
            if ((strtotime($tiempoActual) - strtotime($_SESSION['ultimoAcceso'])) >= $tiempoInactividad){
                $ruta = './modelos/Logout.php';
                echo "<script>
                    alert('Tiempo de sesión expirado por inactividad');
                    location.href = '$ruta';
                </script>";
            }
            else {
                $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            }
        }
    }

    if (isset($_REQUEST['peticion'])) {
        $peticion = $_REQUEST['peticion'];
    }
    else {
        session_start();
        if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])) {
            $correo = $_SESSION['correo'];
            $nombre = $_SESSION['nombre'];
            $peticion = 'registros-solicitudes';
        }
        else {
            $peticion = 'login';
        }
    }

    switch ($peticion) {
        case 'login':
            require_once('./vistas/login.php');
            break;
        case 'verificar-login':
            require_once('./modelos/Login.php');
            break;
        case 'registros-solicitudes':
            require_once('./modelos/RegistrosSolicitudes.php');
            require_once('./vistas/registros-solicitudes.php');
            break;
        case 'administrar-cuentas':
            require_once('./modelos/AdministrarCuentas.php');
            require_once('./vistas/administrar-cuentas.php');
            break;
        case 'logout':
            require_once('./modelos/Logout.php');
            break;
        default:
            require_once('./vistas/login.php');
            break;
    }
?>