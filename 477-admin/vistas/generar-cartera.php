<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Cartera</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <?php include_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor p-1">
            <h1>Generar Cartera de Candidatos</h1>
            <form class="card grid col-4" action="./?peticion=generar-cartera-pdf" method="post">
                <div class="span-2 med-span-4">
                    <label for="fecha-inicio">Inicio</label>
                    <input class="input" type="date" name="fecha-inicio" id="fecha-inicio" required>
                    
                    <label for="fecha-final">Final</label>
                    <input class="input" type="date" name="fecha-final" id="fecha-final" required>
                    
                    <input class="checkbox" type="checkbox" name="cualquierFecha" value="todas" id="cualquierFecha">
                    <label for="cualquierFecha">Todas las solicitudes</label>
                    
                    <p class="mb-1 span-4">Elige dos fechas para seleccionar las solicitudes que serán incluidas en la cartera<br></p>
                </div>
                <div class="span-2 med-span-4 grid col-1">
                    <input class="checkbox" type="checkbox" name="nombre" value="nombre" id="nombre">
                    <label for="nombre">Nombre</label>

                    <input class="checkbox" type="checkbox" name="nombre" value="nombre" id="nombre">
                    <label for="nombre">Dirección</label>

                    <input class="checkbox" type="checkbox" name="nombre" value="nombre" id="nombre">
                    <label for="nombre">Teléfonos</label>

                    <input class="checkbox" type="checkbox" name="nombre" value="nombre" id="nombre">
                    <label for="nombre">Emails</label>

                    <input class="checkbox" type="checkbox" name="nombre" value="nombre" id="nombre">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="span-2">
                    <button class="btn med-span-4" type="submit">Generar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>