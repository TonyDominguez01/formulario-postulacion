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
            
            $idsFilter = $ids;
            $nombresFilter = $nombres;
            $emailsFilter = $emails;
            $fechasFilter = $fechas;
            $telefonosFilter = $telefonos;
            echo '<script>
                ids = '.json_encode($ids) .
                'nombres ='.json_encode($nombres).
                'emails ='.json_encode($emails).
                'fechas ='.json_encode($fechas).
                'telefonos ='.json_encode($telefonos).
            '</script>';

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
                const buscarRegistros = () => {
                    
                }
            </script>
            <?php require_once('./components/nav.php'); ?>
            <div class="contenedor">
                <div class="contendor-ancho mt-2">
                    <h1>Registros de Solicitudes</h1>
                    <div class="contenedor-ancho">
                        <div class="toggle-div">
                            <button id="toggle-btn-l" type="button" class="toggle-btn l active" onclick=cambiarToggle()>Buscar</button>
                            <button id="toggle-btn-r" type="button" class="toggle-btn r" onclick=cambiarToggle()>Filtrar</button>
                        </div>
                        <div class="mt-1 grid col-2">
                            <div>
                                <form id="form-buscar" class="mb-1 bg-none grid col-2 active">
                                    <p>Puedes buscar solicitudes por nombre o por correo</p>
                                    <input id="input-busqueda" class="input" type="text">
                                    <button class="btn" type="button" onclick=buscarRegistros()>Buscar</button>
                                </form>
                                <form id="form-filtrar" class="mb-1 bg-none">
                                    <p>Elige dos fechas para ver las solicitudes recibidas en ese periodo de tiempo</p>
                                    <input id="input-fecha-inicio" class="input" type="date" name="inicio" id="fecha-inicio">
                                    <input id="input-fecha-final" class="input" type="date" name="final" id="fecha-final">
                                    <button class="btn" type="button">Filtrar</button>
                                </form>
                            </div>
                            <div>
                                
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
                                    <td><?php echo $nombresFilter[$i] ?></td>
                                    <td><?php echo $emailsFilter[$i] ?></td>
                                    <td><?php echo $fechasFilter[$i] ?></td>
                                    <td>
                                        <button class="btn with-icon bg-green" onclick=enviarWhatsapp(<?php echo $telefonos[$i] ?>)>
                                            <div><?php echo $telefonosFilter[$i] ?></div>
                                            <img src="./icons/icon_whatsapp.png" alt="">
                                        </button>
                                    </td>
                                    <td>
                                        <button class='btn with-icon' onclick=abrirPDF(<?php echo $idsFilter[$i]; ?>)><div>ver pdf </div><img src="./icons/icon_pdf.png"></button>
                                    </td>
                                    <td>
                                        <button class='btn with-icon bg-red' onclick="abrirBorrar('<?php echo "$ids[$i]', '$nombresFilter[$i]"; ?>')"><div>eliminar</div><img src="./icons/icon_delete.png"></button>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    </table>
                    <table id="tabla-prueba" class="tabla solicitudes">
                        
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
            <script>
                tabla = document.getElementById('tabla-prueba');
                for (let i = 0; i < nombres.length; i++) {
                    const tr = document.createElement('tr')

                    let tdNombre = document.createElement('td')
                    let txtNombre = document.createTextNode(nombres[$i])
                    tdNombre.appendChild(txtNombre)

                    let tdEmail = document.createElement('td')
                    let txtEmail = document.createTextNode(nombres[$i])
                    tdEmail.appendChild(txtEmail)

                    let tdFecha = document.createElement('td')
                    let txtFecha = document.createTextNode(nombres[$i])
                    tdFecha.appendChild(txtFecha)

                    let tdTelefono = document.createElement('td')
                    let txtTelefono = document.createTextNode(nombres[$i])
                    tdTelefono.appendChild(txtTelefono)

                    let tdPdf = document.createElement('td')
                    let txtPdf = document.createTextNode(nombres[$i])
                    tdPdf.appendChild(txtPdf)

                    let tdEliminar = document.createElement('td')
                    let txtEliminar = document.createTextNode(nombres[$i])
                    tdEliminar.appendChild(txtEliminar)

                    td.appendChild(tdNombre)
                    td.appendChild(tdEmail)
                    td.appendChild(tdFecha)
                    td.appendChild(tdTelefono)
                    td.appendChild(tdPdf)
                    td.appendChild(tdEliminar)
                    tabla.appendChild(tr)
                }
            </script>
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