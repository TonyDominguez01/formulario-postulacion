<?php
    require_once('./config/config.php');
    verificarActividad();

    $actualizarPassword = true;
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if ($password != '') {
            $password = md5($_POST['password']);
        }
        else $actualizarPassword = false;
    }

    if (isset($_POST['estatus'])) $estado = 1;
    else $estado = 0;
    
    // Conexion
    require_once('./modelos/Conexion.php');

    if ($actualizarPassword) {
        $sql = "UPDATE `destinatarios` SET `correo` = '$correo', `nombre` = '$nombre', `password` = '$password', `estatus` = $estado WHERE `correo` = '$correo';";
    }
    else {
        $sql = "UPDATE `destinatarios` SET `correo` = '$correo', `nombre` = '$nombre', `estatus` = $estado WHERE `correo` = '$correo';";
    }
    $query = mysqli_query($conexion, $sql);

    mysqli_close($conexion);
    
    if ($query) {
        echo "<script>
        alert('Datos guardados');
        location.href = './?peticion=administrar-cuentas';
        </script> <br>";
    }
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>