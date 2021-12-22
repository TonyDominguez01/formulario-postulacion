<?php
    verificarActividad();
    
    require_once('./modelos/Conexion.php');

    //Recuperar permisos
    $sql = "SELECT * FROM permisos";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $nombresPermiso = array();
        while ($row = @mysqli_fetch_array($query)) {
            $nombresPermiso[$row['idPermiso']] = $row['nombre'];
        }
    }
    
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `nombre`, `estatus`, `estatusCorreo`, `idPermiso` FROM usuarios";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $correos = array();
        $nombres = array();
        $estatuses = array();
        $estatusesCorreo = array();
        $permisos = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $correos[$cont] = $row['correo'];
            $nombres[$cont] = utf8_encode($row['nombre']);
            $estatuses[$cont] = $row['estatus'];
            $estatusesCorreo[$cont] = $row['estatusCorreo'];
            $permisos[$cont] = $row['idPermiso'];
            $cont++;
        }
        mysqli_close($conexion);
    }
    else {
        echo "<script>
            alert('No se logró recuperar los datos');
        </script>";
    }
?>