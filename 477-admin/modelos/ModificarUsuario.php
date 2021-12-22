<?php
    verificarActividad();
    $correo = $_GET['correo'];
    // Conexion
    require_once('./modelos/Conexion.php');

    //Recuperar permisos
    $sql = "SELECT * FROM permisos";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $idsPermiso = array();
        $nombresPermiso = array();
        while ($row = @mysqli_fetch_array($query)) {
            $nombresPermiso[$row['idPermiso']] = $row['nombre'];
            $idsPermiso[$row['idPermiso']] = $row['idPermiso'];
        }
    }
    
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `nombre`, `estatus`, `estatusCorreo`, `idPermiso` FROM usuarios WHERE `correo` = '$correo'";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $datos = mysqli_fetch_array($query);
        $correo = $datos['correo'];
        $nombre = utf8_encode($datos['nombre']);
        $estatus = $datos['estatus'];
        $estatusCorreo = $datos['estatusCorreo'];
        $permiso = $datos['idPermiso'];
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