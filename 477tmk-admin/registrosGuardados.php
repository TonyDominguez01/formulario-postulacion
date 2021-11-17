<?php
    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
    // Recuperar destinatdatosarios
    $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01` FROM postulantes";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $ids = array();
        $nombres = array();
        $emails = array();
        $telefonos = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $ids[$cont] = $row['idPostulante'];
            $nombres[$cont] = $row['nombre'];
            $emails[$cont] = $row['email01'];
            $telefonos[$cont] = $row['telefono01'];
            $cont++;
        }
    }
    else {
        echo "<script>
            alert('Acceso denegado');
            location.href = 'index.html';
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros Guardados</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <script>
        const abrirPDF = (id) => {            
            window.open('verSolicitud.php?id=' + id, '_blank');
        }
    </script>
    <div class="contenedor margen-superior-4">
        <h1>Registros guardados</h1>
        <table class="tabla">
            <tr class="headers">
                <td>Nombre</td>
                <td>Email 1</td>
                <td>Teléfono 1</td>
                <td>PDF</td>
                <button></button>
            </tr>
            <?php
                for ($i=0; $i < sizeof($ids); $i++) { 
                    echo "<tr>
                        <td>$nombres[$i]</td>
                        <td>$emails[$i]</td>
                        <td>$telefonos[$i]</td>
                        <td>
                            <button class='btn' onclick=abrirPDF($ids[$i])>Ver PDF</button>
                        </td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>