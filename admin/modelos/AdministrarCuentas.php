<?php
    session_start();
    verificarActividad();
    
    require_once('./modelos/Conexion.php');
    
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `nombre`, `estatus` FROM destinatarios";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $correos = array();
        $nombres = array();
        $estatuses = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $correos[$cont] = $row['correo'];
            $nombres[$cont] = utf8_encode($row['nombre']);
            $estatuses[$cont] = $row['estatus'];
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