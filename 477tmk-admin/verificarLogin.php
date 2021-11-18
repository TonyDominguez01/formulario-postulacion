<?php
    
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    
    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
    // Recuperar destinatarios
    $sql = "SELECT * FROM destinatarios WHERE `password` = '$password'";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
    if ($row != NULL) {
        session_start();
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['nombre'] = $row['nombre'];
        echo "<script>
            alert('Acceso correcto');
            location.href = 'registrosGuardados.php';
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