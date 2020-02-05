<?php

if(!isset($_SESSION)){
    session_start();
}

require 'constants.php';
 
$login_s = false;
$name_s = null;
$occupation_s = null;
$department_s = null;
$your_assignment = true;
$batch = null;
            
if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    $login_s = $_SESSION['login']; 
    $name_s = ucwords($_SESSION['name']);
    $designation_s = ucfirst($_SESSION['designation']);
    $occupation_s = $_SESSION['occupation'];
    $department_s = $_SESSION['department'];
    $batch = $_SESSION['batch'];
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

mysqli_select_db($conn, "erp_datas");

if($conn->connect_error){
    die('Database error:'.$conn->connect_error);
}