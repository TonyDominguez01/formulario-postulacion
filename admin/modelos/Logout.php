<?php
    session_destroy();
    echo "<script>
        location.href = '". URL_SITE ."';
    </script>";
?>