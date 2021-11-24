<?php
    session_start();

    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])) {
        $emailBorrar = '';
        $correo = $_SESSION['correo'];
        $nombre = $_SESSION['nombre'];
        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        // Recuperar solicitudes
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
                $nombres[$cont] = utf8_encode($row['nombre']);
                $emails[$cont] = $row['email01'];
                $telefonos[$cont] = $row['telefono01'];
                $cont++;
            }
            mysqli_close($conexion);
        }
        else {
            echo "<script>
                alert('No se logró recuperar los datos');
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
            <title>Registros de Solicitudes</title>
            <link rel="stylesheet" href="../ajolote/a-styles.css">
            <script src="../ajolote/a-functions.js"></script>
            <link rel="stylesheet" href="../css/estilos.css">
        </head>
        <body>
            <script>
                let solicitudSeleccionada = '';
                const abrirPDF = (id) => {            
                    window.open('verSolicitud.php?id=' + id, '_blank');
                }
                const abrirBorrar = (id, nombre) => {
                    solicitudSeleccionada = id;
                    document.getElementById('modal-borrar').classList.toggle('active');
                    document.getElementById('txt-borrar').innerHTML = '¿Estás seguro que quieres eliminar la solicitud ' + id + ' de ' + nombre + '?';
                }
                const borrarSolicitud = () => {
                    location.href = './php/borrarSolicitud.php?id=' + solicitudSeleccionada;
                }
            </script>
            <?php require_once('./components/nav.php'); ?>
            <div class="contenedor">
                <div class="contendor-ancho margen-superior-4">
                    <h1>Registros de Solicitudes</h1>
                    <table class="tabla">
                        <tr class="headers">
                            <td>Nombre</td>
                            <td>Email 1</td>
                            <td>Teléfono 1</td>
                            <td>PDF</td>
                            <td>Eliminar</td>
                        </tr>
                        <?php
                            for ($i=0; $i < sizeof($ids); $i++) { 
                            ?>
                                <tr>
                                    <td><?php echo $nombres[$i] ?></td>
                                    <td><?php echo $emails[$i] ?></td>
                                    <td><?php echo $telefonos[$i] ?></td>
                                    <td>
                                        <button class='btn bg-green' onclick=abrirPDF(<?php echo $ids[$i]; ?>)>Ver PDF</button>
                                    </td>
                                    <td>
                                        <button class='btn bg-red' onclick="abrirBorrar('<?php echo "$ids[$i]', '$nombres[$i]"; ?>')">Eliminar</button>
                                    </td>
                                </tr>
                            <?php
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
                    <button class="btn bg-red" onclick=borrarSolicitud()>Eliminar</button>
                </div>
            </div>
        </body>
        </html>
<?php
    }
    else {
        echo "<script>
            location.href = '../error.php';
        </script>";
    }
?>