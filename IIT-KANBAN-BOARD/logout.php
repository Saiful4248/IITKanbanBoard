<?php
session_start();

if (isset($_SESSION['signinemail'])) {
    
    session_unset();

    session_destroy();
}

header("Location: index.html");
exit();
?>
