<nav class="menu">
    <div class="contenedor" id="nav">
        <div class="menu-icon" onclick=MostrarOcultarMenu()><p>☰</p></div>
        <div class="encabezado-m inline-flex">
            <p><?php echo $_SESSION['nombre']; ?></p>
        </div>
        <?php
        if ($_SESSION['permiso'] == 0) {
        ?>
            <a class='link' href='./?peticion=administrar-cuentas'>Cuentas</a>
            <a class='link' href='./?peticion=mantenimiento'>Mantenimiento</a>
        <?php
        }
        ?>
            <a class='link' href='./?peticion=registros-solicitudes'>Solicitudes Completas</a>
            <a class='link' href='./?peticion=solicitudes-contacto'>Solicitudes de Contacto</a>
        <a class="link" href="./?peticion=logout">Cerrar Sesión</a>
    </div>
</nav>