<?php
session_start();

session_unset();
session_destroy();

echo "<script>
        var startpt = ( window.history.length - 4) * -1;
        window.history.go(startpt);
        </script>";
?>