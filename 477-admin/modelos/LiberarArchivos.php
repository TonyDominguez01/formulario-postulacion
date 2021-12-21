<?php
    verificarActividad();
    
    $files = glob('../pdf/*.pdf'); //obtenemos el nombre de todos los ficheros
    $cont = 0;
    foreach($files as $file){
        $lastModifiedTime = filemtime($file);
        $currentTime = time();
        $timeDiff = abs($currentTime - $lastModifiedTime)/(60*60);
        if(is_file($file) && $timeDiff > 24) {
            unlink($file); //elimino el fichero
            $cont++;
        }
    }
    $restantes = (sizeof($files) - $cont);
    echo "<script>
        location.href = './?peticion=mantenimiento&borrados=$cont&restantes=$restantes'
    </script>";
?>