<?php
    $actualizarPassword = true;
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    if ($password != '') $password = md5($_POST['password']);
    else $actualizarPassword = false;

    if (isset($_POST['estatus'])) $estado = 1;
    else $estado = 0;

    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    if ($actualizarPassword) {
        $sql = "UPDATE `destinatarios` SET `correo` = '$correo', `nombre` = '$nombre', `password` = '$password', `estatus` = $estado WHERE `correo` = '$correo';";
    }
    else {
        $sql = "UPDATE `destinatarios` SET `correo` = '$correo', `nombre` = '$nombre', `estatus` = $estado WHERE `correo` = '$correo';";
    }
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        echo "<script>
        alert('Datos guardados');
        location.href = '../vAdministrarCuentas.php';
        </script> <br>";
    }
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>