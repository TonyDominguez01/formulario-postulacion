<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        include_once('./verificarActividad.php');
        verificarActividad(1);
        $idPostulante = $_GET['id'];

        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM `postulantes` WHERE `idPostulante` = '$idPostulante'";
        $query = mysqli_query($conexion, $sql);

        if ($query) {
            echo "<script>
            alert('Solicitud eliminada');
            location.href = '../vRegistrosSolicitudes';
            </script>";
        } 
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
        }
    }
?>