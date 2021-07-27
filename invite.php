<?php

require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


$stmt = $pdo->prepare("INSERT INTO invitation (post_id, client_id, freelancer_id) VALUES (?, ?, ?)");
$stmt->execute([$_GET['postId'], $_SESSION['id'], $_GET['userId']]);

$stmt = $pdo->prepare("UPDATE post SET status = 'wait for request' WHERE id = ? ");
$stmt->execute([$_GET['postId']]);


$loc = "location: profile.php?id=".$_GET['userId'];
header($loc);




?>