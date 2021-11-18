<?php
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $password = md5($_POST['password']);

    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `destinatarios` (`correo`, `nombre`, `password`) VALUES ('$correo', '$nombre', '$password');";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        echo "<script>
        alert('Datos guardados');
        location.href = 'enviarDatos.php?id=" . $idPostulante ."';
        </script> <br>";
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>