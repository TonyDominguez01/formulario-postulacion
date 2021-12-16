<?php
    require_once('./config/config.php');

    verificarActividad();

    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $password = md5($_POST['password']);

    // Conexion
    require_once('./modelos/Conexion.php');

    $sql = "INSERT INTO `usuarios` (`correo`, `nombre`, `password`, `estatus`, `estatusCorreo`) VALUES ('$correo', '$nombre', '$password', 1, 1);";
    $query = mysqli_query($conexion, $sql);

    mysqli_close($conexion);

    if ($query) {
        echo "<script>
        alert('Datos guardados');
        location.href = './?peticion=usuario-guardado&correo=$correo&nombre=$nombre';
        </script>";
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>