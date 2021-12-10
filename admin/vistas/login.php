<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../ajolote/a-functions.js"></script>
</head>
<body>
    <div class="contenedor-reducido pt-4 text-center">
        <div class="card form-cont bg-white">
            <div class="encabezado-form text-right">
                <h1>Login</h1>
            </div>
            <form class="contenedor ph-2 pv-5" action="./index.php" method="POST">
                <label for="correo">Correo</label>
                <input class="input" type="text" name="correo" id="correo" required>
                <label for="password">Password</label>
                <input class="input" type="password" name="password" id="password" required>
                <input type="hidden" id="peticion" name="peticion" value="verificar-login">
                <button class="btn" type="submit">ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
