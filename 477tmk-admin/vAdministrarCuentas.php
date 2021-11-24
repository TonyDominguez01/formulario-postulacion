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
    <script>
        let usuarioSeleccionado = '';
        const abrirBorrar = (correo) => {
            usuarioSeleccionado = correo;
            document.getElementById('modal-borrar').classList.toggle('active');
            document.getElementById('txt-borrar').innerHTML = '¿Estás seguro que quieres eliminar al usuario con correo ' + correo + '?';
        }
        const borrarUsuario = () => {
            location.href = './php/borrarUsuario.php?correo=' + usuarioSeleccionado;
        }
    </script>
    <?php require_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-ancho margen-superior-4">
            <h1>Administrar Cuentas</h1>
            <div class="contenedor-ancho no-padding text-right">
                <a class="btn bg" href="vRegistrarUsuario.php">Agregar cuenta</a>
            </div>
            <table class="tabla">
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
                        if ($estatuses[$i]) $indicadorCls = 'bg-green';
                        else $indicadorCls = 'bg-red';
                        echo "<tr>
                            <td>$correos[$i]</td>
                            <td>$nombres[$i]</td>
                            <td><div class='indicador $indicadorCls'></div></td>
                            <td>
                                <a class='btn bg-green' href='vModificarUsuario.php?correo=$correos[$i]'>modificar</a>
                            </td>
                            <td>
                                <button class='btn bg-red' onclick=abrirBorrar('$correos[$i]')>eliminar</a>
                            </td>
                        </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    <div id="modal-borrar" class="modal-div">
        <div class="modal-content">
            <h2>Confirmar operación</h2>
            <p id="txt-borrar"></p>
            <br>
            <button class="btn" onclick=abrirBorrar()>Volver</button>
            <button class="btn bg-red" onclick=borrarUsuario()>Eliminar</button>
        </div>
    </div>
</body>
</html>
<?php
    }
?>