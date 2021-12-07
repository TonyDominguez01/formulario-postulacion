<?php
    require_once('../../php/config.php');
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);
    $permisoAdmin = false;
    
    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM tableadmin WHERE `correo` = '$correo' AND `password` = '$password'";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
    if ($row != NULL) {
        $permisoAdmin = true;
    }
    else {
        $permisoAdmin = false;
    }

    $sql = "SELECT * FROM destinatarios WHERE `correo` = '$correo' AND `password` = '$password'";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
    if ($row != NULL) {
        if ($row['estatus'] == 1) {
            // server should keep session data for AT LEAST 1 hour
            ini_set('session.gc_maxlifetime', 3600);
    
            // each client should remember their session id for EXACTLY 1 hour
            session_set_cookie_params(60);
    
            session_start();
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['permisoAdmin'] = $permisoAdmin;
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            echo "<script>
                alert('Acceso correcto');
                location.href = '../registros-solicitudes';
            </script>";
        }
        else {
            echo "<script>
                alert('Usuario inhabilitado');
                location.href = '../index';
            </script>";
        }
    }
    else {
        echo "<script>
            alert('Credenciales incorrectas');
            location.href = '../index';
        </script>";
    }
    mysqli_close($conexion);
?>