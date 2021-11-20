<?php
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);
    $permisoAdmin = false;
    
    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
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
        session_start();
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['permisoAdmin'] = $permisoAdmin;
        echo "<script>
            alert('Acceso correcto');
            location.href = 'vRegistrosSolicitudes.php';
        </script>";
    }
    else {
        echo "<script>
            alert('Acceso denegado');
            location.href = 'index.php';
        </script>";
    }
    mysqli_close($conexion);
?>