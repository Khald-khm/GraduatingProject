<?php

require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


$stmt = $pdo->prepare('UPDATE post SET freelancer_id = ?, status = "in progress" WHERE id = ?');
$stmt->execute([$_GET['userId'], $_GET['postId']]);

$loc = "location: profile.php?id=".$_GET['userId'];

header($loc);

?>