<?php
    session_destroy();
    echo "<script>
        location.href = './?peticion=login';
    </script>";
?>