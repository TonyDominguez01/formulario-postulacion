<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Registrar Usuario';
    $extras = '<script src="./js/password.js"></script>';
    require_once('./components/head.php');
?>
<body>
    <div class="main">
        <?php include_once('./components/nav.php'); ?>
        <div id="contenedor" class="contenedor">
            <div class="contenedor-reducido card form-cont">
                <div class="encabezado-form text-right">
                    <h1>Registrar Usuario</h1>
                </div>
                <form class="pt-3 pb-3" action="./index.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" class="input" name="nombre" type="text">
                    <label for="correo">Correo</label>
                    <input id="correo" class="input" name="correo" type="email">
                    <label for="password">Password</label>
                    <button id="ocultar-password" type="button" onclick=mostrarOcultar()><img src="./icons/icon_hide.png" alt=""></button>
                    <input id="password" class="input" name="password" type="password">
                    <input type="hidden" id="peticion" name="peticion" value="guardar-usuario">
                    <div class="contenedor-ancho p-0 text-right">
                        <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'">regresar <img src='./icons/icon_volver.png'></button>
                        <button class="btn with-icon bg-green" type="submit">guardar usuario <img src='./icons/icon_save.png'></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>