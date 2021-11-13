<?php
    $nombre = $_GET['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos enviados</title>
    <link rel="stylesheet" href="ajolote/a-styles.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1><?php echo $nombre; ?>, muchas gracias por enviar tu solicitud</h1>
        <h2>Te contactaremos pronto</h2>
    </div>
</body>
</html>