<!DOCTYPE html>
<html lang="es">
<?php
    $title = 'Modificar Usuario';
    $extras = '<script src="./js/password.js"></script>';
    require_once('./components/head.php');
?>
<body>
    <div class="main">
        <?php include_once('./components/nav.php'); ?>
        <div id="contenedor" class="contenedor">
            <div class="contenedor-reducido card form-cont">
                <div class="encabezado-form text-right">
                    <h1>Modificar Usuario</h1>
                </div>
                <form class="pv-3" action="./?peticion=actualizar-usuario" method="POST">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" class="input" name="nombre" type="text" value="<?php echo $nombre; ?>" required>
                    <label for="correo">Correo</label>
                    <input id="correo" class="input" name="correo" type="email" value="<?php echo $correo; ?>" required>
                    <label for="password">Password</label>
                    <button id="ocultar-password" type="button" onclick=mostrarOcultarPlace()><img src="./icons/icon_hide.png" alt="">mostrar</button>
                    <input id="password" class="input" name="password" type="password" placeholder="••••••••">
                    <div>
                        <input id="estatus" class="checkbox" name="estatus" type="checkbox" <?php if($estatus) echo 'checked'; ?>>
                        <label for="estatus">Estatus</label>
                    </div><br>
                    <div>
                        <input id="estatusCorreo" class="checkbox" name="estatusCorreo" type="checkbox" <?php if($estatusCorreo) echo 'checked'; ?>>
                        <label for="estatusCorreo">Se le envían correos</label>
                    </div>
                    <div>
                        <select class="input mv-1" name="permiso" id="permiso">
                            <?php
                                for ($i=0; $i < sizeof($idsPermiso); $i++) { 
                            ?>
                                    <option value="<?php echo $idsPermiso[$i]; ?>" <?php if($permiso == $i) echo 'selected'; ?>><?php echo $nombresPermiso[$i]; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="contenedor-ancho p-0 text-right">
                        <button class="btn with-icon" type="button" onclick="location.href = './?peticion=administrar-cuentas'"><div>regresar </div><img src='./icons/icon_volver.png'></button>
                        <button class="btn with-icon bg-green" type="submit"><div>guardar datos </div><img src='./icons/icon_save.png'></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>