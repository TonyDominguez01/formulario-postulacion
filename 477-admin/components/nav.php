<nav class="nav">
    <div class="contenedor" id="nav">
        <div class="encabezado inline-flex">
            <p><?php echo $_SESSION['nombre']; ?></p>
        </div>
        <div class="nav-menu-icon" onclick=MostrarOcultarMenu()><p>☰</p></div>
    <?php
        if ($_SESSION['permisoAdmin']) {
    ?>
        <a class="link" href="./?peticion=administrar-cuentas">Administrar Cuentas</a>
    <?php
        }
    ?>
        <a class="link" href="./?peticion=registros-solicitudes">Registro de Solicitudes</a>
        <a class="link" href="./?peticion=logout">Cerrar Sesión</a>
    </div>
</nav>