<?php
    session_start();

    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])) {
        include_once('./php/verificarActividad.php');
        verificarActividad(0);
        $emailBorrar = '';
        $correo = $_SESSION['correo'];
        $nombre = $_SESSION['nombre'];
        // Conexion
        $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        // Recuperar solicitudes
        $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes";
        $query = mysqli_query($conexion, $sql);
        if ($query) {
            $ids = array();
            $nombres = array();
            $emails = array();
            $fechas = array();
            $telefonos = array();
            $cont = 0;
            while ($row = @mysqli_fetch_array($query)) {
                $ids[$cont] = $row['idPostulante'];
                $nombres[$cont] = utf8_encode($row['nombre']);
                $emails[$cont] = $row['email01'];
                $fechas[$cont] = $row['fechaRegistro'];
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
                let estadoToggle = true;
                const abrirPDF = (id) => {
                    <?php 
                        include_once('./php/verificarActividad.php');
                        verificarActividad(0);
                    ?>
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
                const enviarWhatsapp = (telefono) => {
                    window.open('https://api.whatsapp.com/send?phone=+52' + telefono, '_blank');
                }
                const cambiarToggle = (e) => {
                    let idRight = e.parentNode.getElementsByClassName('toggle-btn-r')[0].id;
                    let idRight = e.parentNode.getElementsByClassName('toggle-btn-r')[0].id;
                    estadoToggle = !estadoToggle;
                    if (estadoToggle) {
                        document.getElementById(id + '-l').classList.add('active');
                        document.getElementById(id + '-r').classList.remove('active');
                        document.getElementById('form-buscar').classList.add('active');
                        document.getElementById('form-filtrar').classList.remove('active');
                    }
                    else {
                        document.getElementById(id + '-r').classList.add('active');
                        document.getElementById(id + '-l').classList.remove('active');
                        document.getElementById('form-filtrar').classList.add('active');
                        document.getElementById('form-buscar').classList.remove('active');
                    }
                }
            </script>
            <?php require_once('./components/nav.php'); ?>
            <div class="contenedor">
                <div class="contendor-ancho mt-2">
                    <h1>Registros de Solicitudes</h1>
                    <div class="contenedor-ancho">
                        <div id="toggle-0" class="toggle-div">
                            <button type="button" class="toggle-btn l active" onclick=cambiarToggle(this)>Buscar</button>
                            <button type="button" class="toggle-btn r" onclick=cambiarToggle(this)>Filtrar</button>
                        </div>
                        <div class="mt-1">
                            <div id="form-buscar" class="mb-1 active">
                                <p>Puedes buscar solicitudes por nombre o por correo</p>
                                <input id="input-busqueda" class="input" type="text">
                                <button class="btn" type="button">Buscar</button>
                            </div>
                            <div id="form-filtrar" class="mb-1">
                                <p>Elige dos fechas para ver las solicitudes recibidas en ese periodo de tiempo</p>
                                <input id="input-fecha-inicio" class="input" type="date" name="inicio" id="fecha-inicio">
                                <input id="input-fecha-final" class="input" type="date" name="final" id="fecha-final">
                                <button class="btn" type="button">Filtrar</button>
                            </div>
                        </div>
                    </div>
                    <table class="tabla solicitudes">
                        <tr class="headers">
                            <td>Nombre</td>
                            <td>Email 1</td>
                            <td>Fecha de registro</td>
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
                                    <td><?php echo $fechas[$i] ?></td>
                                    <td>
                                        <button class="btn with-icon bg-green" onclick=enviarWhatsapp(<?php echo $telefonos[$i] ?>)>
                                            <div><?php echo $telefonos[$i] ?></div>
                                            <img src="./icons/icon_whatsapp.png" alt="">
                                        </button>
                                    </td>
                                    <td>
                                        <button class='btn with-icon' onclick=abrirPDF(<?php echo $ids[$i]; ?>)><div>ver pdf </div><img src="./icons/icon_pdf.png"></button>
                                    </td>
                                    <td>
                                        <button class='btn with-icon bg-red' onclick="abrirBorrar('<?php echo "$ids[$i]', '$nombres[$i]"; ?>')"><div>eliminar</div><img src="./icons/icon_delete.png"></button>
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