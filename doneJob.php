<?php


require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


$stmt = $pdo->prepare('UPDATE post SET status = "done" WHERE id = ?');
$stmt->execute([$_GET['id']]); 


header('location: manageProjectsCompany.php');


?>
