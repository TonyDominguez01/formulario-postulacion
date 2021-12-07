<?php
    require_once('../php/config.php');
    session_start();

    if (isset($_SESSION['correo']) AND isset($_SESSION['nombre'])) {
        include_once('./php/verificarActividad.php');
        verificarActividad(0);
        $emailBorrar = '';
        $correo = $_SESSION['correo'];
        $nombre = $_SESSION['nombre'];
        // Conexion
        $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (!$conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        // Recuperar solicitudes
        $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes";
        $query = mysqli_query($conexion, $sql);

        if (!isset($_GET['page'])) $page = 1;
        else $page = $_GET['page'];
        $totalPages = ceil(mysqli_num_rows($query) / ITEMS_BY_PAGE);
        if ($page > $totalPages) $page = 1;
        $start = ($page - 1) * ITEMS_BY_PAGE;

        $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes
            ORDER BY `nombre` ASC LIMIT $start, " . ITEMS_BY_PAGE;
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
                alert('No se logró recuperar los datos');;
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
            <script src="./js/registros-solicitudes.js"></script>
        </head>
        <body>
            <script>
                const abrirPDF = (id) => {
                <?php 
                    include_once('./php/verificarActividad.php');
                    verificarActividad(0);
                ?>
                    window.open('ver-solicitud?id=' + id, '_blank');
                }
            </script>
            <?php require_once('./components/nav.php'); ?>
            <div class="contenedor">
                <div class="contendor-ancho mt-2">
                    <h1>Registros de Solicitudes</h1>
                    <div class="contenedor-ancho">
                        <div class="grid col-4">
                            <div class="toggle-div">
                                <button id="toggle-filtro-l" type="button" class="toggle-btn l active" onclick=cambiarFiltro()>Buscar</button>
                                <button id="toggle-filtro-r" type="button" class="toggle-btn r" onclick=cambiarFiltro()>Filtrar</button>
                            </div>
                            <div class="span-3">
                                <form id="form-buscar" class="m-0 bg-none active">
                                    <input id="input-busqueda" class="input" type="text">
                                    <button class="btn" type="button" onclick=buscarRegistros()>Buscar</button>
                                    <p class="mb-1">Puedes buscar solicitudes por nombre o por correo</p>
                                </form>
                                <form id="form-filtrar" class="m-0 bg-none">
                                    <input id="input-fecha-inicio" class="input" type="date" name="inicio" id="fecha-inicio">
                                    <input id="input-fecha-final" class="input" type="date" name="final" id="fecha-final">
                                    <button class="btn" type="button">Filtrar</button>
                                    <p class="mb-1">Elige dos fechas para ver las solicitudes recibidas en ese periodo de tiempo</p>
                                </form>
                            </div>
                        </div>
                        <div id="toggle-ordenar">
                            <div>Ordenar por: </div>
                            <div>
                                <div class="toggle-div">
                                    <button id="toggle-ordenar-l" type="button" class="toggle-btn l active">Nombre</button>
                                    <button id="toggle-ordenar-r" type="button" class="toggle-btn r">Fecha</button>
                                </div>
                            </div>
                            <div>Página no. <?php echo $page; ?></div>
                            <div>
                                <button class="btn bg-green"> < </button>
                                <button class="btn bg-green"> > </button>
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
                                        <button class='btn with-icon bg-red' onclick="abrirBorrar('<?php echo "$ids[$i]', '$nombresFilter[$i]"; ?>')"><div>eliminar</div><img src="./icons/icon_delete.png"></button>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    </table>
                        
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
            location.href = '../error';
        </script>";
    }
?>