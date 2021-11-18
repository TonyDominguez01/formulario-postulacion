<?php
    session_start();
    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])){
        echo "<script>
            location.href = 'registrosSolicitudes.php';
        </script>";
    }
    else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="contenedor-reducido text-center">
        <div class="contenedor card form-cont">
            <div class="encabezado-form text-right">
                <h1>Login</h1>
            </div>
            <form class="contenedor-reducido padding-superior-5 padding-inferior-5" action="verificarLogin.php" method="POST" style="margin: 0 auto;">
                <label for="correo">Correo</label>
                <input class="input" type="text" name="correo" id="correo" required>
                <label for="password">Password</label>
                <input class="input" type="password" name="password" id="password" required>
                <button class="btn" type="submit">ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }
?>