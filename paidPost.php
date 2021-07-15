<?php

require('connect.php');

session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if($_SESSION['group_id'] != 3)
{
    header('location: login.php');
}


if(isset($_GET['post_id']))
{
    $stmt = $pdo->prepare("UPDATE post SET paid_status = true, company_id = ? WHERE id = ?");
    $stmt->execute([$_SESSION['id'], $_GET['post_id']]);
    header('location: BrowseJobsCompany.php');
}

?>