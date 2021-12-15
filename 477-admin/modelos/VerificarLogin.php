<?php
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
    
    if ($row != NULL) $permisoAdmin = true;

    $sql = "SELECT * FROM destinatarios WHERE `correo` = '$correo' AND `password` = '$password'";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
    if ($row != NULL) {
        if ($row['estatus'] == 1) {
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['permisoAdmin'] = $permisoAdmin;
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            echo "<script>
                location.href = './?peticion=registros-solicitudes';
            </script>";
        }
        else {
            echo "<script>
                alert('Usuario inhabilitado');
                location.href = './?peticion=login';
            </script>";
        }
    }
    else {
        echo "<script>
            alert('Credenciales incorrectas');
            location.href = './?peticion=login';
        </script>";
    }
    mysqli_close($conexion);
?>
