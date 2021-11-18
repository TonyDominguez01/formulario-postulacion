<?php
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        if ($_SESSION['permisoAdmin']){
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
            <form action="guardarUsuario.php" method="POST">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="input" name="nombre" type="text">
                <label for="correo">Correo</label>
                <input id="correo" class="input" name="correo" type="email">
                <label for="correo">Password</label>
                <input id="password" class="input" name="password" type="password">
                <div class="contenedor-ancho no-padding text-right">
                    <button class="btn margen-inferior-3" type="submit">registrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
        }
    }
?>