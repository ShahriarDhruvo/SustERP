<?php

require 'constants.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

mysqli_select_db($conn, "erp_datas");

if($conn->connect_error){
    die('Database error:'.$conn->connect_error);
}