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

        //Recuperar datos tomando en cuenta si ha sido aplicado un filtro
        if (isset($_POST['buscar'])) {
            $busqueda = $_POST['busqueda'];
            $filtro = 'buscar';
            $valor = "busqueda=$busqueda";
            $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes
            WHERE `nombre` LIKE '%$busqueda%' OR `email01` LIKE '%$busqueda%'";
        }
        else if (isset($_POST['filtrar'])) {
            $fechaInicio = $_POST['fecha-inicio'];
            $fechaFinal = $_POST['fecha-final'];
            $filtro = 'filtrar';
            $valor = "fechaInicio=$fechaInicio&fechaFinal=$fechaFinal";
            $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes
            WHERE `fechaRegistro` BETWEEN CAST('$fechaInicio' AS DATE) AND CAST('$fechaFinal' AS DATE)";
        }
        else {
            $filtro = 'todos';
            $valor = 'a';
            $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes";

            if (isset($_GET['filtro'])) {
                $filtro = $_GET['filtro'];
                switch ($filtro) {
                    case 'buscar':
                        $busqueda = $_GET['busqueda'];
                        $valor = "busqueda=$busqueda";
                        $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes
                        WHERE `nombre` LIKE '%$busqueda%' OR `email01` LIKE '%$busqueda%'";
                        break;
                    case 'filtrar':
                        $fechaInicio = $_GET['fechaInicio'];
                        $fechaFinal = $_GET['fechaFinal'];
                        $valor = "fechaInicio=$fechaInicio&fechaFinal=$fechaFinal";
                        $sql = "SELECT `idPostulante`, `nombre`, `email01`, `telefono01`, `fechaRegistro` FROM postulantes
                        WHERE `fechaRegistro` BETWEEN CAST('$fechaInicio' AS DATE) AND CAST('$fechaFinal' AS DATE)";
                        break;
                    default:
                        break;
                }
            }
        }
        
        $query = mysqli_query($conexion, $sql);

        //Recuperar criterio de ordenación
        if (isset($_GET['ordenar'])) {
            $criterio = $_GET['ordenar'];
            switch ($criterio) {
                case 'nombre': break;
                case 'fechaRegistro': break;
                case 'fecha': $criterio = 'fechaRegistro'; break;
                default: $criterio = 'nombre'; break;
            }
        }
        else $criterio = 'nombre';

        //Recuperar sentido de ordenación
        $sentido = 'asc';
        if (isset($_GET['sentido'])) {
            $sentido = $_GET['sentido'];
            switch ($sentido) {
                case 'asc': break;
                case 'desc': break;
                default: $sentido = 'asc'; break;
            }
        }

        //Recuperar número de paginas
        if (!isset($_GET['page'])) $page = 1;
        else $page = $_GET['page'];

        $totalPages = ceil(mysqli_num_rows($query) / ITEMS_BY_PAGE);
        $rowsTotales = mysqli_num_rows($query);
        
        $pagAnt = $page - 1;
        $pagSig = $page + 1;

        //Verificaciones de página
        if ($page <= 1) {
            $page = 1;
            $pagAnt = $page;
            $pagSig = $page + 1;
        }
        if ($page >= $totalPages) {
            $page = $totalPages;
            $pagAnt = $totalPages - 1;
            $pagSig = $totalPages;
        }

        $start = ($page - 1) * ITEMS_BY_PAGE;

        $sql .= " ORDER BY `$criterio` $sentido LIMIT $start, " . ITEMS_BY_PAGE;
        
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

        }
        else {
            echo "<script>
            alert('No se logró recuperar los datos');;
            </script>";
        }
        mysqli_close($conexion);
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
                <div class="contendor-ancho mv-2">
                    <h1>Registros de Solicitudes</h1>
                    <div class="contenedor-ancho">
                        <div class="grid col-4">
                            <div class="toggle-div peq-span-4">
                                <button id="toggle-filtro-l" type="button" class="toggle-btn width-6 l" onclick=cambiarFiltro()>buscar</button>
                                <button id="toggle-filtro-r" type="button" class="toggle-btn width-6 r" onclick=cambiarFiltro()>filtrar</button>
                            </div>
                            <div class="span-3 peq-span-4">
                                <form id="form-buscar" class="m-0 bg-none active" method="POST" action="./registros-solicitudes">
                                    <input id="busqueda" name="busqueda" class="input" type="text">
                                    <input type="hidden" name="buscar" id="buscar" value="buscar">
                                    <button class="btn" type="submit">buscar</button>
                                    <button class="btn bg-red" type="button" onclick="location.href = './registros-solicitudes'">limpiar busqueda</button>
                                    <p class="mb-1">Puedes buscar solicitudes por nombre o por correo</p>
                                </form>
                                <form id="form-filtrar" class="m-0 bg-none" method="POST" action="./registros-solicitudes">
                                    <input class="input" type="date" name="fecha-inicio" id="fecha-inicio">
                                    <input class="input" type="date" name="fecha-final" id="fecha-final">
                                    <input type="hidden" name="filtrar" id="filtrar" value="filtrar">
                                    <button class="btn" type="submit">filtrar</button>
                                    <button class="btn bg-red" type="button" onclick="location.href = './registros-solicitudes'">limpiar filtro</button>
                                    <p class="mb-1">Elige dos fechas para ver las solicitudes recibidas en ese periodo de tiempo</p>
                                </form>
                            </div>
                        </div>
                        <div id="toggle-ordenar" class="grid col-7">
                            <div class="inline-flex l span-4 med-span-7">
                                <p>Ordenar por: </p>
                                <div>
                                    <div class="toggle-div">
                                        <a id="toggle-ordenar-l" type="button" class="toggle-btn width-6 l with-icon" href='<?php echo "?page=$page&ordenar=nombre&sentido=$sentido&filtro=$filtro&$valor"; ?>'>
                                            nombre
                                        </a>
                                        <a id="toggle-ordenar-r" type="button" class="toggle-btn width-6 r with-icon" href='<?php echo "?page=$page&ordenar=fecha&sentido=$sentido&filtro=$filtro&$valor"; ?>'>
                                            fecha
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <div class="toggle-div">
                                        <a id="toggle-sentido-l" type="button" class="toggle-btn width-4 l with-icon active" href='<?php echo "?page=$page&ordenar=$criterio&sentido=desc&filtro=$filtro&$valor"; ?>'>
                                            <img src="./icons/icon_desc.png" alt="">
                                        </a>
                                        <a id="toggle-sentido-r" type="button" class="toggle-btn width-4 r with-icon" href='<?php echo "?page=$page&ordenar=$criterio&sentido=asc&filtro=$filtro&$valor"; ?>'>
                                            <img src="./icons/icon_asc.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="inline-flex r span-3 med-span-7">
                                <div class="text-right">
                                    <a class="btn" href='<?php echo "?page=$pagAnt&ordenar=$criterio&sentido=$sentido&filtro=$filtro&$valor"; ?>'><b><</b></a>
                                    <a class="btn" href='<?php echo "?page=$pagSig&ordenar=$criterio&sentido=$sentido&filtro=$filtro&$valor"; ?>'><b>></b></a>
                                </div>
                                <p class="text-right"><?php echo $page; ?> / <?php echo $totalPages; ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p id="results"></p>
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
                                    <td><?php echo date_format(date_create($fechas[$i]), "d/m/Y - H:i:s"); ?></td>
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
                        
                    </table>
                </div>
            </div>
            <div id="modal-borrar" class="modal-div">
                <div class="modal-content">
                    <h2>Confirmar operación</h2>
                    <p id="txt-borrar"></p>
                    <br>
                    <button class="btn" onclick=cerrarBorrar()>volver</button>
                    <button class="btn bg-red" onclick=borrarSolicitud()>eliminar</button>
                </div>
            </div>
        </body>
        </html>
<?php
        if ($criterio == 'nombre') {
            echo "<script>
                document.getElementById('toggle-ordenar-l').classList.add('active');
                document.getElementById('toggle-ordenar-r').classList.remove('active');
            </script>";
        }
        else {
            echo "<script>
                document.getElementById('toggle-ordenar-r').classList.add('active');
                document.getElementById('toggle-ordenar-l').classList.remove('active');
            </script>";
        }
        if ($sentido == 'desc') {
            echo "<script>
                document.getElementById('toggle-sentido-l').classList.add('active');
                document.getElementById('toggle-sentido-r').classList.remove('active');
            </script>";
        }
        else {
            echo "<script>
                document.getElementById('toggle-sentido-r').classList.add('active');
                document.getElementById('toggle-sentido-l').classList.remove('active');
            </script>";
        }
        if ($filtro == 'buscar') {
            echo "<script>
                document.getElementById('toggle-filtro-l').classList.add('active');
                document.getElementById('toggle-filtro-r').classList.remove('active');
                document.getElementById('form-buscar').classList.add('active');
                document.getElementById('form-filtrar').classList.remove('active');

                document.getElementById('results').innerHTML = '<b>$rowsTotales</b> solicitude(s) encontrada(s) de la busqueda <b>$_POST[busqueda]</b>';
            </script>";
        }
        else if ($filtro == 'filtrar') {
            $inicio = date_format(date_create($fechaInicio), 'd/m/Y');
            $final = date_format(date_create($fechaFinal), 'd/m/Y');
            echo "<script>
                document.getElementById('toggle-filtro-r').classList.add('active');
                document.getElementById('toggle-filtro-l').classList.remove('active');
                document.getElementById('form-filtrar').classList.add('active');
                document.getElementById('form-buscar').classList.remove('active');

                document.getElementById('results').innerHTML = '<b>$rowsTotales</b> solicitude(s) recibida(s) entre el <b>$inicio</b> y el <b>$final</b>';
            </script>";
        }
        else {
            echo "<script>
                document.getElementById('toggle-filtro-l').classList.add('active');
                document.getElementById('toggle-filtro-r').classList.remove('active');
            </script>";
        }
    }
    else {
        echo "<script>
            location.href = '../error';
        </script>";
    }
?>