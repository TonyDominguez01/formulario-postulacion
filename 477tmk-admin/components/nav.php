<nav class="nav">
    <div class="contenedor" id="nav">
        <div class="encabezado">
            <p><?php echo $_SESSION['nombre']; ?></p>
        </div>
        <div class="nav-menu-icon" onclick=MostrarOcultarMenu()><p>☰</p></div>
    <?php
        if ($_SESSION['permisoAdmin']) {
    ?>
        <a class="link" href="./administrar-cuentas">Administrar cuentas</a>
        <a class="link" href="./registros-solicitudes">Registro de solicitudes</a>
    <?php
        }
    ?>
        <a class="link" href="./php/cerrarSesion">Cerrar Sesión</a>
    </div>
</nav>