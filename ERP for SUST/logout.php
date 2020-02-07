<?php
    require 'config/db.php';
    require_once 'controllers/authController.php';

    session_destroy();
    unset($_SESSION['login']);
    unset($_SESSION['department']);
    unset($_SESSION['batch']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['occupation']);
    unset($_SESSION['verified']);

    $URL="login.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';
    exit();
?>