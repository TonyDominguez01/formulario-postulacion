<?php
    require_once('../php/config.php');
    session_start();
    if (isset($_SESSION['permisoAdmin'])){
        if ($_SESSION['permisoAdmin']){
            include_once('./php/verificarActividad.php');
            verificarActividad(0);
            $correo = $_GET['correo'];
            // Conexion
            $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            if (!$conexion) {
                die("Error de conexion: " . mysqli_connect_error());
            }
            // Recuperar destinatarios
            $sql = "SELECT `correo`, `nombre`, `estatus` FROM destinatarios WHERE `correo` = '$correo'";
            $query = mysqli_query($conexion, $sql);
            if ($query) {
                $datos = mysqli_fetch_array($query);
                $correo = $datos['correo'];
                $nombre = utf8_encode($datos['nombre']);
                $estatus = $datos['estatus'];
                mysqli_close($conexion);
            }
            else {
                echo "<script>
                    alert('No se logró recuperar los datos');
                    location.href = 'index.php';
                </script>";
            }
            mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar usuario</title>
    <link rel="stylesheet" href="../ajolote/a-styles.css">
    <script src="../ajolote/a-functions.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <?php include_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-reducido card form-cont">
            <div class="encabezado-form text-right">
                <h1>Modificar Usuario</h1>
            </div>
            <form class="pv-3" action="./php/actualizarUsuario.php" method="POST">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="input" name="nombre" type="text" value="<?php echo $nombre; ?>" required>
                <label for="correo">Correo</label>
                <input id="correo" class="input" name="correo" type="email" value="<?php echo $correo; ?>" required>
                <label for="correo">Password</label>
                <input id="password" class="input" name="password" type="password">
                <input id="estatus" class="checkbox" name="estatus" type="checkbox" <?php if($estatus) echo 'checked'; ?>>
                <label for="estatus">Estatus</label>
                <div class="contenedor-ancho p-0 text-right">
                    <button class="btn with-icon" type="button" onclick="location.href = './administrar-cuentas.php'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
                    <button class="btn with-icon bg-green" type="submit"><div>guardar datos </div><img src='./icons/icon_save.png'></button>
                    
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