<?php
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
    // Recuperar destinatarios
    $sql = "SELECT `correo`, `password` FROM destinatarios";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $correosDest = array();
        $nombresDest = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $correosDest[$cont] = $row['correo'];
            $nombresDest[$cont] = $row['nombre'];
            $cont++;
        }
    }
?>