<?php


require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


// the link has an id so
$postId = $_GET['id'];


// post information

$stmt = $pdo->prepare('SELECT username, post.id, freelancer_id, title, post.description, cost, DATE_FORMAT(post.start_date, "%m/%d/%Y") start_date, post.skills, status FROM post, user WHERE post.id = ? AND client_id = user.id');
$stmt->execute([$postId]);
$post = $stmt->fetch();



// get the skills in an array

$skillArr = explode(", ", $post['skills']);




// Query for insert a new proposal
// the description is the textarea which called proposal

if(isset($_POST['makeBid']))
{
    $stmt = $pdo->prepare('INSERT INTO proposal (post_id, freelancer_id, description, publish_date) VALUES (?, ?, ?, ?)');
    $stmt->execute([$postId, $_SESSION['id'], $_POST['proposal'], date("Y-m-d H:i:s")]);
    unset($_POST);
    header("Location: postAndProposals.php" . '?id='.$postId);
    
}



// query for proposals

$stmt = $pdo->prepare('SELECT username, user.id, description, DATE_FORMAT(publish_date, "%m/%d/%Y") publish_date FROM proposal, user WHERE post_id = ? AND freelancer_id = user.id');
$stmt->execute([$postId]);
$proposal = $stmt->fetchAll();





// when client choose a freelancer from its post page
// put the link and a freeId with it when making the layout


if(isset($_POST['chooseFree']))
{
    $stmt = $pdo->prepare("UPDATE post SET freelancer_id = ? WHERE post.id = ?");
    $stmt->execute([$_POST['userId'], $postId]);
    unset($_POST);
    header("Location: postAndProposals.php" . '?id='.$postId);

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>

    <div style="border: 1px solid;">

        <?php

            // The information we need to display them in post page

            echo $post['title'].'</br>';

            echo $post['username'].'</br>';

            echo $post['description'].'</br>';

            echo $post['cost'].'</br>';

            echo $post['start_date'].'</br>';

            
            foreach($skillArr as $row)
            {
                echo $row.'</br>';
            }

        
        ?>

    </div>

    <form method="post" action="">
    
        <textarea type="text" name="proposal" ></textarea>
        <input type="submit" name="makeBid" value="propose">
    
    </form>
    

    <div>
    
        <?php 

            foreach($proposal as $row)
            {
                
                echo $row['username']. '</br>';

                if($post['freelancer_id'] == NULL)
                {
                    echo '<form method="post" action="">
                        <input type="hidden" name="userId" value='. $row["id"] .'>
                        <input type="submit" name="chooseFree" value="Choose Freelancer"></form>' ;
                }

                echo $row['publish_date'].'</br>';
                echo $row['description'].'</br>'.'</br>';

            }

        ?>

    </div>



</body>
</html>