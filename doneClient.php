<?php


require('connect.php');

session_start();


if(isset($_GET['post_id']))
{
    $stmt = $pdo->prepare("UPDATE post SET status = 'pay' WHERE id = ?");
    $stmt->execute([$_GET['post_id']]);

    header('location: manageProjectClient.php');
}
