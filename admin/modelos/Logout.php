<?php
    session_start();
    session_destroy();
    echo "<script>
        location.href = '". URL_SITE ."';
    </script>";
?>