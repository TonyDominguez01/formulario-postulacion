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
            <?php verificarActividad(); ?>
            window.open('./vistas/ver-solicitud.php?id=' + id, '_blank');
        }
        const generarCartera = () => {
            <?php verificarActividad(); ?>
            window.open('./vistas/generar-cartera.php', '_blank');
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
                        <button id="toggle-filtro-r" type="button" class="toggle-btn width-6 r m-2" onclick=cambiarFiltro()>filtrar</button>
                    </div>
                    <div class="span-3 peq-span-4">
                        <form id="form-buscar" class="m-0 bg-none active" method="POST" action="./peticion=registros-solicitudes">
                            <input id="busqueda" name="busqueda" class="input" type="text" required>
                            <input type="hidden" name="buscar" id="buscar" value="buscar">
                            <button class="btn" type="submit">buscar</button>
                            <button class="btn bg-red" type="button" onclick="location.href = './?peticion=registros-solicitudes'">limpiar busqueda</button>
                            <p class="mb-1">Puedes buscar solicitudes por nombre o por correo</p>
                        </form>
                        <form id="form-filtrar" class="m-0 bg-none" method="POST" action="./?peticion=registros-solicitudes">
                            <input class="input" type="date" name="fecha-inicio" id="fecha-inicio" required>
                            <input class="input" type="date" name="fecha-final" id="fecha-final" required>
                            <input type="hidden" name="filtrar" id="filtrar" value="filtrar">
                            <button class="btn" type="submit">filtrar</button>
                            <button class="btn bg-red" type="button" onclick="location.href = './?peticion=registros-solicitudes'">limpiar filtro</button>
                            <p class="mb-1">Elige dos fechas para ver las solicitudes recibidas en ese periodo de tiempo</p>
                        </form>
                    </div>
                </div>
                <div id="toggle-ordenar" class="grid col-7">
                    <div class="inline-flex l span-4 med-span-7">
                        <p>Ordenar por: </p>
                        <div>
                            <div class="toggle-div">
                                <a id="toggle-ordenar-l" type="button" class="toggle-btn width-6 l with-icon" href='<?php echo "?peticion=registros-solicitudes&page=$page&ordenar=nombre&sentido=$sentido&filtro=$filtro&$valor"; ?>'>
                                    nombre
                                </a>
                                <a id="toggle-ordenar-r" type="button" class="toggle-btn width-6 r with-icon" href='<?php echo "?peticion=registros-solicitudes&page=$page&ordenar=fecha&sentido=$sentido&filtro=$filtro&$valor"; ?>'>
                                    fecha
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="toggle-div">
                                <a id="toggle-sentido-l" type="button" class="toggle-btn width-4 l with-icon" href='<?php echo "?peticion=registros-solicitudes&page=$page&ordenar=$criterio&sentido=asc&filtro=$filtro&$valor"; ?>'>
                                    <img src="./icons/icon_asc.png" alt="">
                                </a>
                                <a id="toggle-sentido-r" type="button" class="toggle-btn width-4 r with-icon" href='<?php echo "?peticion=registros-solicitudes&page=$page&ordenar=$criterio&sentido=desc&filtro=$filtro&$valor"; ?>'>
                                    <img src="./icons/icon_desc.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="inline-flex r span-3 med-span-7">
                        <div class="text-right">
                            <a class="btn" href='<?php echo "?peticion=registros-solicitudes&page=$pagAnt&ordenar=$criterio&sentido=$sentido&filtro=$filtro&$valor"; ?>'><b><</b></a>
                            <a class="btn" href='<?php echo "?peticion=registros-solicitudes&page=$pagSig&ordenar=$criterio&sentido=$sentido&filtro=$filtro&$valor"; ?>'><b>></b></a>
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
                    <td>Fecha de solicitud</td>
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
                                <button class="btn with-icon bg-green" onclick=enviarWhatsapp(<?php echo $telefonos[$i]; ?>)>
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
            <div class="mv-2">
                <button class="btn" type="button" onclick="generarCartera()">Generar Cartera de Candidatos</button>
            </div>
        </div>
    </div>
    <div id="modal-borrar" class="modal-div">
        <div class="modal-content">
            <h2>Confirmar operación</h2>
            <p id="txt-borrar"></p><br>
            <button class="btn" onclick=cerrarBorrar()>volver</button>
            <button class="btn bg-red" onclick=borrarSolicitud()>eliminar</button>
        </div>
    </div>
</body>
</html>

<?php
    if ($criterio == 'nombre')echo "<script> ordenarPorNombre(); </script>";
    else echo "<script> ordenarPorFecha(); </script>";

    if ($sentido == 'desc') echo "<script> ordenarDescendente(); </script>";
    else echo "<script> ordenarAscendente(); </script>";

    if ($filtro == 'buscar') {
        echo "<script> actualizarBuscar('$rowsTotales', '$_POST[busqueda]'); </script>";
    }
    else if ($filtro == 'filtrar') {
        $inicio = date_format(date_create($fechaInicio), 'd/m/Y');
        $final = date_format(date_create($fechaFinal), 'd/m/Y');
        echo "<script> actualizarFiltrar('$rowsTotales', '$inicio', '$final'); </script>";
    }
    else {
        echo "<script> mostrarBuscar(); </script>";
    }
?>