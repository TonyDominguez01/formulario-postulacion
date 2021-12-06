<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        if ($_SESSION['permisoAdmin']){
            include_once('./php/verificarActividad.php');
            verificarActividad(0);
            if (isset($_GET['correo']) && isset($_GET['nombre'])){
?>
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
        <button class="btn with-icon" type="button" onclick="location.href = './administrar-cuentas.php'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
    </div>
</body>
</html>
<?php
            }
            else {
        echo "<script>
                location.href = './registros-solicitudes.php'
            </script>";
            }
        }
    }
    else {
        echo "<script>
            location.href = '../error.php?error=403';
        </script>";
    }
?>