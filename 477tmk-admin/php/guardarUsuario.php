<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        include_once('./verificarActividad.php');
        verificarActividad(1);

        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $password = md5($_POST['password']);

        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO `destinatarios` (`correo`, `nombre`, `password`, `estatus`) VALUES ('$correo', '$nombre', '$password', 1);";
        $query = mysqli_query($conexion, $sql);

        if ($query) {
            echo "<script>
            alert('Datos guardados');
            location.href = '../vUsuarioGuardado?correo=$correo&nombre=$nombre';
            </script> <br>";
        } 
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
        }
    }
?>