<?php
    verificarActividad(0);

    require_once('./Modelos/Conexion.php');

    $sql = "DELETE FROM `candidatos` WHERE `idPostulante` = '$idPostulante'";
    $query = mysqli_query($conexion, $sql);

    mysqli_close($conexion);

    if ($query) {
        echo "<script>
        alert('Solicitud eliminada');
        location.href = './?peticion=registros-solicitudes';
        </script>";
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>