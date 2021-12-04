<?php
    $error = $_GET['error'];
    $mensaje = '';
    switch ($error) {
        case '404':
            $mensaje = 'Página no encontrada';
            break;
        case '400':
            $mensaje = 'Solicitud incorrecta';
            break;
        case '401':
            $mensaje = 'Ha fallado la autentificación';
            break;
        case '403':
            $mensaje = 'Permisos de acceso incorrectos';
            break;
        case '500':
            $mensaje = 'Error interno';
            break;
        default:
            $mensaje = 'Página no encontrada';
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="ajolote/a-styles.css">
    <script src="ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor mt-2">
        <h1>Error <?php echo $error; ?></h1>
        <br>
        <h2>Página no encontrada</h2>
        <button class="btn" onclick=window.open('http://477tmk.mx')>regresar a 477TMK</button>
    </div>
</body>
</html>