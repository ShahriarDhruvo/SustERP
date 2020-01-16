<?php
    $dbh = new PDO("mysql:host=localhost; dbname=erp_datas", "root", "");
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $stat = $dbh->prepare("select * from assignments where id=?");
    $stat->bindParam(1, $id);
    $stat->execute();
    $row = $stat->fetch();
    header('Content-Type: '.$row['type']);
    echo $row['data'];
?>