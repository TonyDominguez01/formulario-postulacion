<?php
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    
    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuarios WHERE (`correo` = '$usuario' OR `nombre` = '$usuario') AND `password` = '$password'";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
    if ($row != NULL) {
        if ($row['estatus'] == 1) {
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['permiso'] = $row['idPermiso'];
            $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            echo "<script>
                location.href = './';
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
