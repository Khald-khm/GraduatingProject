<?php
    require_once 'connect.php';
 
    if(ISSET($_REQUEST['file_id'])){
        $file = $_REQUEST['file_id'];
        $query = $pdo->prepare("SELECT * FROM `files` WHERE `id`= ?");
        $query->execute([$file]);
        $fetch = $query->fetch();
 
        header("Content-Disposition: attachment; filename=".$fetch['storage_name']);
        header("Content-Type: application/octet-stream;");
        readfile("D:/upload/".$fetch['name']);
    }
?>