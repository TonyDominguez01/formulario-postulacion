<!DOCTYPE html>
<html lang="es">
<?php
    $title = 'Usuario Guardado';
    $extras = '';
    require_once('./components/head.php');
?>
<body>
    <?php include_once('./components/nav.php') ?>
    <div class="contenedor mt-2">
        <h1>El usuario con el correo <b><?php echo $_GET['correo']; ?></b>, y el nombre <b><?php echo $_GET['nombre']; ?></b> ha sido registrado.</h1>
        <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
    </div>
</body>
</html>
