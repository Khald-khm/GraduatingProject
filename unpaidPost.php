<?php

// this page for client who had not publish or paid for its post

require('connect.php');

session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if($_SESSION['group_id'] != 2)
{
    header('location: login.php');
}


$stmt = $pdo->prepare("SELECT id FROM post WHERE client_id =?  AND paid_status = true");
$stmt->execute([$_SESSION['id']]);

if($stmt->rowCount() >= 1)
{
    
    $_SESSION['paidPost'] = true;
    header('location: BrowseFreelancers.php');
}

$_SESSION['padiPost'] = false;


?>