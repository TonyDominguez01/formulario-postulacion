<?php
    require_once('../../php/config.php');
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        include_once('./verificarActividad.php');
        verificarActividad(1);
        $idPostulante = $_GET['id'];

        // Conexion
        $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM `postulantes` WHERE `idPostulante` = '$idPostulante'";
        $query = mysqli_query($conexion, $sql);

        mysqli_close($conexion);

        if ($query) {
            echo "<script>
            alert('Solicitud eliminada');
            location.href = '../registros-solicitudes';
            </script>";
        } 
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
        }
    }
?>