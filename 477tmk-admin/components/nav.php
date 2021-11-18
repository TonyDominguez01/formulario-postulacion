<div class="nav">
    <div class="encabezado">
        <p><?php echo $_SESSION['nombre']; ?></p>
    </div>
    <div class="nav-menu-icon" onclick=MostrarOcultarMenu()><p>☰</p></div>
<?php
    if ($_SESSION['permisoAdmin']) {
?>
    <a class="link" href="administrarCuentas.php">Administrar cuentas</a>
    <a class="link" href="registrosSolicitudes.php">Registro de solicitudes</a>
<?php
    }
?>
    <a class="link" href="cerrarSesion.php">Cerrar Sesión</a>
</div>