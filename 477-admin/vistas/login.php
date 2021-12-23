<!DOCTYPE html>
<html lang="es">
<?php
    $title = 'Login';
    $extras = '<script src="./js/password.js"></script>';
    require_once('./components/head.php');
?>
<body>
    <div class="contenedor pt-4 pb-1 text-center">
        <div class="card login grid col-5 bg-white">
            <div class="login-img span-2 peq-span-5">
                <img src="../img/logo.png" alt="logo">
            </div>
            <div class="span-3 peq-span-5 bg-white p-2">
                <h1>Login</h1>
                <form class="ph-0 pv-3" action="./index.php" method="POST">
                    <label for="usuario">Correo o Usuario</label>
                    <input class="input" type="text" name="usuario" id="usuario" required>
                    <label for="password">Password</label>
                    <button id="ocultar-password" type="button" onclick=mostrarOcultar()><img src="./icons/icon_hide.png" alt=""></button>
                    <input class="input" type="password" name="password" id="password" required>
                    <input type="hidden" id="peticion" name="peticion" value="verificar-login">
                    <button class="btn" type="submit">ingresar</button>
                </form>
            </div>
        </div>
        <!-- <div class="card login bg-white">
            <div class="encabezado-form text-right">
                <h1>Login</h1>
            </div>
            <form class="ph-0 pv-5" action="./index.php" method="POST">
                <label for="usuario">Correo o Usuario</label>
                <input class="input" type="text" name="usuario" id="usuario" required>
                <label for="password">Password</label>
                <button id="ocultar-password" type="button" onclick=mostrarOcultar()><img src="./icons/icon_hide.png" alt=""></button>
                <input class="input" type="password" name="password" id="password" required>
                <input type="hidden" id="peticion" name="peticion" value="verificar-login">
                <button class="btn" type="submit">ingresar</button>
            </form>
        </div> -->
    </div>
</body>
</html>
