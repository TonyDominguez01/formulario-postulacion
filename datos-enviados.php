<?php
    if (isset($_GET['nombre'])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/diadema.png" type="image/x-icon">
    <title>Gracias por tu solicitud</title>
    <link rel="stylesheet" href="ajolote/a-styles.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="ajolote/a-functions.js"></script>
</head>
<body>
    <div class="contenedor mt-2">
        <h1>Muchas gracias <b><?php echo $_GET['nombre']; ?></b>, tu solicitud ha sido enviada.</h1>
        <button class="btn mt-2" onclick=window.open('http://477tmk.mx')>regresar a 477TMK</button>
    </div>
</body>
</html>
<?php
    }
    else {
        echo "<script>
            location.href = './index.php'
        </script>";
    }
?>