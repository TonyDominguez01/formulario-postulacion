<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
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
                <h1>Modificar Usuario</h1>
            </div>
            <form class="pv-3" action="./?peticion=actualizar-usuario" method="POST">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="input" name="nombre" type="text" value="<?php echo $nombre; ?>" required>
                <label for="correo">Correo</label>
                <input id="correo" class="input" name="correo" type="email" value="<?php echo $correo; ?>" required>
                <label for="password">Password</label>
                <button id="ocultar-password" type="button" onclick=mostrarOcultarPlace()><img src="./icons/icon_hide.png" alt="">mostrar</button>
                <input id="password" class="input" name="password" type="password" placeholder="••••••••">
                <div>
                    <input id="estatus" class="checkbox" name="estatus" type="checkbox" <?php if($estatus) echo 'checked'; ?>>
                    <label for="estatus">Estatus</label>
                </div><br>
                <div>
                    <input id="estatusCorreo" class="checkbox" name="estatusCorreo" type="checkbox" <?php if($estatusCorreo) echo 'checked'; ?>>
                    <label for="estatus">Se le envían correos</label>
                </div>
                <div class="contenedor-ancho p-0 text-right">
                    <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
                    <button class="btn with-icon bg-green" type="submit"><div>guardar datos </div><img src='./icons/icon_save.png'></button>
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>