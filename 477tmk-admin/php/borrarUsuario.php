<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        include_once('./verificarActividad.php');
        verificarActividad(1);
        $correo = $_GET['correo'];

        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM `destinatarios` WHERE `correo` = '$correo'";
        $query = mysqli_query($conexion, $sql);

        if ($query) {
            echo "<script>
            alert('Usuario eliminado');
            location.href = '../vAdministrarCuentas.php';
            </script>";
        } 
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
        }
    }
?>