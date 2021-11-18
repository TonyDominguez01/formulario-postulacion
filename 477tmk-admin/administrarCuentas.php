<?php
    session_start();
    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])){
        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        // Recuperar destinatarios
        $sql = "SELECT `correo`, `nombre`, `estatus` FROM destinatarios";
        $query = mysqli_query($conexion, $sql);
        if ($query) {
            $correos = array();
            $nombres = array();
            $estatuses = array();
            $cont = 0;
            while ($row = @mysqli_fetch_array($query)) {
                $correos[$cont] = $row['correo'];
                $nombres[$cont] = utf8_encode($row['nombre']);
                $estatuses[$cont] = $row['estatus'];
                $cont++;
            }
            mysqli_close($conexion);
        }
        else {
            echo "<script>
                alert('No se logró recuperar los datos');
                location.href = 'index.php';
            </script>";
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cuentas</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <?php require_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-ancho margen-superior-4">
            <h1>Administrar Cuentas</h1>
            <div class="contenedor-ancho no-padding text-right">
                <a class="btn bg-green" href="registrarUsuario.php">Agregar cuenta</a>
            </div>
            <table class="tabla cuentas">
                <tr class="headers">
                    <td>Correo</td>
                    <td>Nombre</td>
                    <td>Estatus</td>
                    <td>Modificar</td>
                    <td>Borrar</td>
                    <a href=""></a>
                </tr>
                <?php
                    for ($i=0; $i < sizeof($correos); $i++) { 
                        echo "<tr>
                            <td>$correos[$i]</td>
                            <td>$nombres[$i]</td>
                            <td>$estatuses[$i]</td>
                            <td>
                                <a class='btn' href='modificarUsuario.php?correo=$correos[$i]'>modificar</a>
                            </td>
                            <td>
                            <a class='btn bg-red' href='borrarUsuario.php?correo=$correos[$i]'>borrar</a>
                            </td>
                        </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php
    }
?>