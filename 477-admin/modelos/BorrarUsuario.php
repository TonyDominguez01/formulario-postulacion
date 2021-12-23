<?php
    require_once('./config/config.php');

    verificarActividad();

    require_once('./modelos/Conexion.php');

    $sql = "DELETE FROM `usuarios` WHERE `correo` = '$correo'";
    $query = mysqli_query($conexion, $sql);

    mysqli_close($conexion);

    if ($query) {
        echo "<script>
        alert('Usuario eliminado');
        location.href = './?peticion=administrar-cuentas';
        </script>";
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }
?>