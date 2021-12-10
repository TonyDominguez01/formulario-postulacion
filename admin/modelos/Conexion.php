<?php
    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
?>