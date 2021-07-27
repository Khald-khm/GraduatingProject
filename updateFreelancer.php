<?php

require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if($_GET['accept'] == 'true')
{       
    $stmt = $pdo->prepare('UPDATE invitation SET accept = true WHERE post_id = ? AND freelancer_id = ?');
    $stmt->execute([$_GET['postId'], $_SESSION['id']]);

    $stmt = $pdo->prepare('UPDATE post SET freelancer_id = ?, status = "in progress" WHERE id = ?');
    $stmt->execute([$_SESSION['id'], $_GET['postId']]);

    $loc = "location: manageProjectsFree.php";
    header($loc);
}

if($_GET['accept'] == 'false')
{
    $stmt = $pdo->prepare('UPDATE invitation SET accept = false WHERE post_id = ? AND freelancer_id = ?');
    $stmt->execute([$_GET['postId'], $_SESSION['id']]);

    $stmt = $pdo->prepare('UPDATE post SET status = "available" WHERE id = ?');
    $stmt->execute([$_GET['postId']]);

    $loc = "location: manageProjectsFree.php";
    header($loc);
    
}




?>