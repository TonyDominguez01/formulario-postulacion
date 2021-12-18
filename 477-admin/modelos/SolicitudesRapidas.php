<?php
    verificarActividad();

    require_once('./modelos/Conexion.php');

    //Recuperar datos tomando en cuenta si ha sido aplicado un filtro
    if (isset($_REQUEST['buscar'])) {
        $busqueda = $_POST['busqueda'];
        $filtro = 'buscar';
        $valor = "busqueda=$busqueda";
        $sql = "SELECT `nombre`, `correo`, `telefono`, `fechaRegistro`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `horaInicio`, `horaFinal` FROM solicitudesrapidas
        WHERE `nombre` LIKE '%$busqueda%' OR `correo` LIKE '%$busqueda%'";
    }
    else if (isset($_REQUEST['filtrar'])) {
        $fechaInicio = $_POST['fecha-inicio'];
        $fechaFinal = $_POST['fecha-final'];
        $filtro = 'filtrar';
        $valor = "fechaInicio=$fechaInicio&fechaFinal=$fechaFinal";
        $sql = "SELECT `nombre`, `correo`, `telefono`, `fechaRegistro`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `horaInicio`, `horaFinal` FROM solicitudesrapidas
        WHERE `fechaRegistro` >= CAST('$fechaInicio' AS DATE) AND `fechaRegistro` <= DATE_ADD(CAST('$fechaFinal' AS DATE),INTERVAL 1 DAY)";
    }
    else {
        $filtro = 'todos';
        $valor = 'a';
        $sql = "SELECT `nombre`, `correo`, `telefono`, `fechaRegistro`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `horaInicio`, `horaFinal` FROM solicitudesrapidas";
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

    $nombres = array();
    $correos = array();
    $telefonos = array();
    $fechas = array();
    $lunes = array();
    $martes = array();
    $miercoles = array();
    $jueves = array();
    $viernes = array();
    $sabados = array();
    $horasInicio = array();
    $horasFinal = array();
    $disponibles = array();

    if ($query) {
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $nombres[$cont] = utf8_encode($row['nombre']);
            $correos[$cont] = $row['correo'];
            $telefonos[$cont] = $row['telefono'];
            $fechas[$cont] = $row['fechaRegistro'];

            $lunes[$cont] = $row['lunes'];
            $martes[$cont] = $row['martes'];
            $miercoles[$cont] = $row['miercoles'];
            $jueves[$cont] = $row['jueves'];
            $viernes[$cont] = $row['viernes'];
            $sabados[$cont] = $row['sabado'];

            $horasInicio[$cont] = $row['horaInicio'];
            $horasFinal[$cont] = $row['horaFinal'];

            $diaActual = date('w');
            $fechaActual = date('Y/m/d');
            $horaActual = date('H:i');
            $disponibles[$cont] = 0;
            switch ($diaActual) {
                case '1':
                    if ($lunes[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                case '2':
                    if ($martes[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                case '3':
                    if ($miercoles[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                case '4':
                    if ($jueves[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                case '5':
                    if ($viernes[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                case '6':
                    if ($sabados[$cont] == '1') $disponibles[$cont] = 1;
                    break;
                default:
                    break;
            }
            if ($disponibles[$cont] == 1){
                if (!(strtotime($horaActual) > strtotime($horasInicio[$cont]) && strtotime($horaActual) < strtotime($horasFinal[$cont]))) {
                    $disponibles[$cont] = 0;
                }
            }

            $cont++;
        }
    }
    mysqli_close($conexion);
?>