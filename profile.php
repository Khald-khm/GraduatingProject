<?php


require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


$stmt = $db->prepare('SELECT * FROM user WHERE id = $_SESSION['id'];')
$stmt->execute(); 
$freelancers = $stmt->fetch();



// for freelancers the jobs have bids , in progress and done 
// if($freelancers['group_id']=1)
// {
//     $stmt = $db->prepare('SELECT * FROM post WHERE $freelancers['freelancer_id'] = $_SESSION['id'];')
// }


// for clients the posts had posted by it
// else if($freelancers['group_id']=1)
// {
//     $stmt = $db->prepare('SELECT * FROM post WHERE $freelancers['client_id'] = $_SESSION['id'];')
// }

?>