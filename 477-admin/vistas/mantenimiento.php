<?php
    verificarActividad();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="./js/administrar-cuentas.js"></script>
</head>
<body>
    <?php require_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-ancho mt-2">
            <h1>Administrar Cuentas</h1>

            <a class="btn" href="./?peticion=liberar-archivos">Liberar Archivos</a>

            <div id="results" class="results"></div>
        </div>
    </div>
</body>
</html>
<?php
    if (isset($_REQUEST['borrados']) && isset($_REQUEST['restantes'])) {
        $borrados = $_REQUEST['borrados'];
        $restantes = $_REQUEST['restantes'];
        echo "<script>
            document.getElementById('results').innerHTML = '<br><p>Archivos borrados: $borrados</p><p>Archivos restantes: $restantes</p>';
        </script>";
    }
?>