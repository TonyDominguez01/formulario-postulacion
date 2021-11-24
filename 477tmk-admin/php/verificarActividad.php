<?php
    function verificarActividad ($posicion){
        if (isset($_SESSION['ultimoAcceso'])) {
            $tiempoActual = date("Y-n-j H:i:s");
            $tiempoInactividad = 30;
            if ((strtotime($tiempoActual) - strtotime($_SESSION['ultimoAcceso'])) >= $tiempoInactividad){
                if ($posicion == 0) {
                    $ruta = './php/cerrarSesion.php';
                }
                else {
                    $ruta = './cerrarSesion.php';
                }
                echo "<script>
                    alert('Tiempo de sesión expirado por inactividad');
                    location.href = '$ruta';
                </script>";
            }
        }
    }
?>