<?php
    require_once 'controllers/authController.php';

    session_destroy();
    unset($_SESSION['login']);
    unset($_SESSION['department']);
    unset($_SESSION['batch']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['occupation']);
    unset($_SESSION['verified']);

    header('Location: login.php');
    exit();
?>