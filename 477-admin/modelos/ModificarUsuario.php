<?php
    verificarActividad();
    $correo = $_GET['correo'];
    // Conexion
    require_once('./modelos/Conexion.php');
    
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `nombre`, `estatus` FROM destinatarios WHERE `correo` = '$correo'";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $datos = mysqli_fetch_array($query);
        $correo = $datos['correo'];
        $nombre = utf8_encode($datos['nombre']);
        $estatus = $datos['estatus'];
        mysqli_close($conexion);
    }
    else {
        mysqli_close($conexion);
        echo "<script>
            alert('No se logró recuperar los datos');
            location.href = 'index.php';
        </script>";
    }
?>