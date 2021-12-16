<?php
    verificarActividad();
    $emailBorrar = '';

    require_once('./modelos/Conexion.php');

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
        WHERE `fechaRegistro` >= CAST('$fechaInicio' AS DATE) AND `fechaRegistro` <= DATE_ADD(CAST('$fechaFinal' AS DATE),INTERVAL 1 DAY)";
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
                    WHERE `fechaRegistro` >= CAST('$fechaInicio' AS DATE) AND `fechaRegistro` <= DATE_ADD(CAST('$fechaFinal' AS DATE),INTERVAL 1 DAY)";
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

    $ids = array();
    $nombres = array();
    $emails = array();
    $fechas = array();
    $telefonos = array();
    if ($query) {
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
    mysqli_close($conexion);
?>