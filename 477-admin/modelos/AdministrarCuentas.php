<?php
    verificarActividad();
    
    require_once('./modelos/Conexion.php');
    
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `nombre`, `estatus`, `estatusCorreo` FROM usuarios";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $correos = array();
        $nombres = array();
        $estatuses = array();
        $estatusesCorreo = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $correos[$cont] = $row['correo'];
            $nombres[$cont] = utf8_encode($row['nombre']);
            $estatuses[$cont] = $row['estatus'];
            $estatusesCorreo[$cont] = $row['estatusCorreo'];
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