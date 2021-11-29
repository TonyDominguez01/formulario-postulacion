<?php
    $files = glob('../../pdf/*.pdf'); //obtenemos el nombre de todos los ficheros
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
    echo 'Arvhivos borrados: ' . $cont . '<br>';
    echo 'Archivos restantes: ' . (sizeof($files) - $cont);
?>