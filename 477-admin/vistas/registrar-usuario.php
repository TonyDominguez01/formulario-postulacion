<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="./js/password.js"></script>
</head>
<body>
    <?php include_once('./components/nav.php'); ?>
    <div class="contenedor">
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
                <button id="ocultar-password" type="button" onclick=mostrarOcultar()><img src="./icons/icon_hide.png" alt="">mostrar</button>
                <input id="password" class="input" name="password" type="password">
                <input type="hidden" id="peticion" name="peticion" value="guardar-usuario">
                <div class="contenedor-ancho p-0 text-right">
                    <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'">regresar <img src='./icons/icon_volver.png'></button>
                    <button class="btn with-icon bg-green" type="submit">guardar usuario <img src='./icons/icon_save.png'></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>