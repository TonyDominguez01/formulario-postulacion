<?php
    function verificarActividad ($posicion){
        if (isset($_SESSION['ultimoAcceso'])) {
            $tiempoActual = date("Y-n-j H:i:s");
            $tiempoInactividad = 900;
            if ((strtotime($tiempoActual) - strtotime($_SESSION['ultimoAcceso'])) >= $tiempoInactividad){
                if ($posicion == 0) {
                    $ruta = './php/cerrarSesion';
                }
                else {
                    $ruta = './cerrarSesion';
                }
                echo "<script>
                    alert('Tiempo de sesión expirado por inactividad');
                    location.href = '$ruta';
                </script>";
            }
            else {
                $_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
            }
        }
    }
?>