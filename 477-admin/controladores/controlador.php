<?php
    function verificarActividad (){
        if (isset($_SESSION['ultimoAcceso'])) {
            $tiempoActual = date("Y-n-j H:i:s");
            $tiempoInactividad = 1800;
            if ((strtotime($tiempoActual) - strtotime($_SESSION['ultimoAcceso'])) >= $tiempoInactividad){
                $ruta = './?peticion=logout';
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
    date_default_timezone_set('America/Mexico_City');

    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    if (isset($_REQUEST['peticion'])) $peticion = $_REQUEST['peticion'];
    else $peticion = 'login';

    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])) {
        $correo = $_SESSION['correo'];
        $nombre = $_SESSION['nombre'];

        switch ($peticion) {
            case 'registros-solicitudes':
                require_once('./modelos/RegistrosSolicitudes.php');
                require_once('./vistas/registros-solicitudes.php');
                break;
            case 'solicitudes-contacto':
                require_once('./modelos/SolicitudesContacto.php');
                require_once('./vistas/solicitudes-contacto.php');
                break;
            case 'ver-solicitud':
                break;
            case 'borrar-solicitud':
                if (isset($_GET['id'])){
                    $idPostulante = $_GET['id'];
                    require_once('./modelos/BorrarSolicitud.php');
                }
                else {
                    echo "<script>
                        alert('No se ha introducido ID');
                        location.href = './?peticion=registros-solicitudes';
                    </script>";
                }
                break;
            case 'borrar-solicitud-rapida':
                if (isset($_GET['correo'])){
                    $correo = $_GET['correo'];
                    require_once('./modelos/BorrarSolicitudRapida.php');
                }
                else {
                    echo "<script>
                        alert('No se ha introducido un correo');
                        location.href = './?peticion=registros-solicitudes';
                    </script>";
                }
                break;
            case 'logout':
                require_once('./modelos/Logout.php');
                break;
            case 'generar-cartera-pdf': 
                break;
            default:
                if ($_SESSION['permiso'] == 0) {
                    switch ($peticion) {
                        case 'administrar-cuentas':
                            require_once('./modelos/AdministrarCuentas.php');
                            require_once('./vistas/administrar-cuentas.php');
                            break;
                        case 'modificar-usuario':
                            require_once('./modelos/ModificarUsuario.php');
                            require_once('./vistas/modificar-usuario.php');
                            break;
                        case 'registrar-usuario':
                            require_once('./vistas/registrar-usuario.php');
                            break;
                        case 'guardar-usuario':
                            require_once('./modelos/GuardarUsuario.php');
                            break;
                        case 'usuario-guardado':
                            require_once('./vistas/usuario-guardado.php');
                            break;
                        case 'actualizar-usuario':
                            require_once('./modelos/ActualizarUsuario.php');
                            break;
                        case 'borrar-usuario':
                            if (isset($_GET['correo'])){
                                $correo = $_GET['correo'];
                                require_once('./modelos/BorrarUsuario.php');
                            }
                            else {
                                echo "<script>
                                    alert('No se ha introducido ID');
                                    location.href = './?peticion=administrar-cuentas';
                                </script>";
                            }
                            break;
                        case 'mantenimiento':
                            require_once('./vistas/mantenimiento.php');
                            break;
                        case 'liberar-archivos':
                            require_once('./modelos/LiberarArchivos.php');
                            break;
                        case 'secciones':
                            require_once('./vistas/secciones.php');
                            require_once('./modelos/Secciones.php');
                            break;
                        default:
                            require_once('./modelos/SolicitudesContacto.php');
                            require_once('./vistas/solicitudes-contacto.php');
                            break;
                    }
                }
                else {
                    require_once('./modelos/SolicitudesContacto.php');
                    require_once('./vistas/solicitudes-contacto.php');
                }
                break;
        }
    }
    else {
        switch ($peticion) {
            case 'login': require_once('./vistas/login.php'); break;
            case 'verificar-login': require_once('./modelos/VerificarLogin.php'); break;
            default: require_once('./vistas/login.php'); break;
        }
    }
?>