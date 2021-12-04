<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        if ($_SESSION['permisoAdmin']){
            include_once('./php/verificarActividad.php');
            verificarActividad(0);
?>
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
</head>
<body>
    <?php include_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-reducido card form-cont">
            <div class="encabezado-form text-right">
                <h1>Registrar usuario</h1>
            </div>
            <form class="pt-3 pb-3" action="./php/guardarUsuario.php" method="POST">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="input" name="nombre" type="text">
                <label for="correo">Correo</label>
                <input id="correo" class="input" name="correo" type="email">
                <label for="correo">Password</label>
                <input id="password" class="input" name="password" type="password">
                <div class="contenedor-ancho p-0 text-right">
                    <button class="btn" type="button" onclick="location.href = './vAdministrarCuentas.php'">regresar</button>
                    <button class="btn bg-green" type="submit">guardar usuario</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
        }
    }
    else {
        echo "<script>
            location.href = '../vError.php?error=403';
        </script>";
    }
?>