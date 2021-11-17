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
        echo "<script>
            alert('Acceso correcto');
            location.href = 'registrosGuardados.php';
        </script>";
    }
    else {
        echo "<script>
            alert('Acceso denegado');
            location.href = 'index.html';
        </script>";
    }
?>