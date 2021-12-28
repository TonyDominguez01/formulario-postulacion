<?php
    verificarActividad();
?>
<!DOCTYPE html>
<html lang="es">
<?php
    $title = 'Mantenimiento';
    $extras = '<script src="./js/password.js"></script>';
    require_once('./components/head.php');
?>
<body>
    <div class="main">
        <?php require_once('./components/nav.php'); ?>
        <div id="contenedor" class="contenedor">
            <div class="contenedor-ancho mt-2">
                <h1>Mantenimiento</h1>
    
                <a class="btn" href="./?peticion=liberar-archivos">Liberar Archivos</a>
    
                <div id="results" class="results"></div>
            </div>
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