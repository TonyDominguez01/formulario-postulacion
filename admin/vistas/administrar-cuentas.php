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
            document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
            document.getElementById('txt-borrar').innerHTML = '¿Estás seguro que quieres eliminar al usuario con correo ' + correo + '?';
        }
        const cerrarBorrar = () => {
            document.getElementById('modal-borrar').classList.toggle('active');
            document.getElementById('modal-borrar').getElementsByClassName('modal-content')[0].classList.toggle('active');
        }
        const borrarUsuario = () => {
            location.href = './php/borrarUsuario?correo=' + usuarioSeleccionado;
        }
    </script>
    <?php require_once('./components/nav.php'); ?>
    <div class="contenedor">
        <div class="contenedor-ancho mt-2">
            <h1>Administrar Cuentas</h1>
            <div class="contenedor-ancho p-0 text-right">
                <a class="btn with-icon" href="registrar-usuario">agregar cuenta <img src='./icons/icon_agregar.png'></a>
            </div>
            <table class="tabla">
                <tr class="headers">
                    <td>Correo</td>
                    <td>Nombre</td>
                    <td>Estatus</td>
                    <td>Modificar</td>
                    <td>Eliminar</td>
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
                                <a class='btn with-icon bg-green' href='modificar-usuario?correo=$correos[$i]'><div>modificar</div><img src='./icons/icon_modificar.png'></a>
                            </td>
                            <td>
                                <button class='btn with-icon bg-red' onclick=abrirBorrar('$correos[$i]')><div>eliminar</div><img src='./icons/icon_delete.png'></a>
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
            <button class="btn" onclick=cerrarBorrar()>Volver</button>
            <button class="btn bg-red" onclick=borrarUsuario()>Eliminar</button>
        </div>
    </div>
</body>
</html>