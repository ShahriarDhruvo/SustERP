<?php
    session_start();
    $_SESSION['login'] = false;
    session_destroy();
    header('Location: index.php');
?>