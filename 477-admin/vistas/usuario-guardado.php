<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Guardado</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../ajolote/a-functions.js"></script>
</head>
<body>
    <?php include_once('./components/nav.php') ?>
    <div class="contenedor mt-2">
        <h1>El usuario con el correo <b><?php echo $_GET['correo']; ?></b>, y el nombre <b><?php echo $_GET['nombre']; ?></b> ha sido registrado.</h1>
        <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
    </div>
</body>
</html>
