<!DOCTYPE html>
<html lang="es">
<?php
    $title = 'Administrar Cuentas';
    $extras = '<script src="./js/administrar-cuentas.js"></script>';
    require_once('./components/head.php');
?>
<body>
    <div class="main">
        <?php require_once('./components/nav.php'); ?>
        <div id="contenedor" class="contenedor">
            <div class="contenedor-ancho mt-2">
                <h1>Administrar Cuentas</h1>
                <div class="contenedor-ancho p-0 text-right">
                    <a class="btn with-icon" href="./?peticion=registrar-usuario">agregar cuenta <img src='./icons/icon_agregar.png'></a>
                </div>
                <table class="tabla">
                    <tr class="headers">
                        <td>Correo</td>
                        <td>Nombre</td>
                        <td>Estatus</td>
                        <td>Se le envían correos</td>
                        <td>Permisos</td>
                        <td>Modificar</td>
                        <td>Eliminar</td>
                    </tr>
                    <?php
                        for ($i=0; $i < sizeof($correos); $i++) { 
                            if ($estatuses[$i]) $indicadorCls = 'bg-green';
                            else $indicadorCls = 'bg-red';
                            if ($estatusesCorreo[$i]) $indicadorCls2 = 'bg-green';
                            else $indicadorCls2 = 'bg-red';
                    ?>
                            <tr>
                                <td><?php echo $correos[$i]; ?></td>
                                <td><?php echo $nombres[$i]; ?></td>
                                <td><div class='indicador <?php echo $indicadorCls; ?>'></div></td>
                                <td><div class='indicador <?php echo $indicadorCls2; ?>'></div></td>
                                <td>
                                    <?php
                                        echo $nombresPermiso[$permisos[$i]];
                                    ?>
                                </td>
                                <td>
                                    <a class='btn with-icon bg-green' href='?peticion=modificar-usuario&correo=<?php echo $correos[$i]; ?>'><div>modificar</div><img src='./icons/icon_modificar.png'></a>
                                </td>
                                <td>
                                    <button class='btn with-icon bg-red' onclick=abrirBorrar('<?php echo $correos[$i]; ?>')><div>eliminar</div><img src='./icons/icon_delete.png'></a>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
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