<?php


require('connect.php');

session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}



// for freelancer
if($_SESSION['group_id'] == 1){
    $stmt = $pdo->prepare('SELECT * FROM post WHERE freelancer_id = ? AND lower(status) = "in progress" AND paid_status = true');
    $stmt->execute([$_SESSION['id']]); 
    $post = $stmt->fetchAll();

    $company = false;
    $client = false;
}




// you should also select the company that is having the project


// for client
else if($_SESSION['group_id'] == 2){
    $stmt = $pdo->prepare('SELECT * FROM post WHERE client_id = ? AND lower(status) = "in progress" AND paid_status = true');
    $stmt->execute([$_SESSION['id']]); 
    $post = $stmt->fetchAll();

    $company = false;
    $client = true;
}

// for transfer company
// I just don't know what is the name of the column we want instead of   freelancer_id
else if($_SESSION['group_id'] == 3){
    $stmt = $pdo->prepare('SELECT * FROM post WHERE company_id = ? AND lower(status) = "in progress" AND paid_status = true');
    $stmt->execute([$_SESSION['id']]); 
    $post = $stmt->fetchAll();

    $client = false;
    $company = true;
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


    

    <h2> Projects </h2>
            
    <?php 

    foreach($post as $row)
    {
        ?>

    
    

        <div class="postDes">
        
            <div class="title"> <?php echo $row['title']; ?> </div>
            <div class="description"> <?php echo $row['description']; ?> </div>
        
        </div>

        </br>

        <?php

        if($client == false && $company == false){
             ?>
        
        <div class="uploadFile">
        
            <form method="POST" action="uploadFiles.php?post_id=<?php echo $row['id']; ?>" enctype="multipart/form-data">
                <div class="form-inline">
                    <input type="file" class="form-control" name="file" required="required"/>
                    <button class="btn btn-primary" name="upload"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                </div>
            </form>

        </div>
            <?php } ?>

        <table class="table table-bordered" style="border-radius: 5px; background-color: #999; width: 100%;">
            <thead class="alert-info">
                <tr>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // for displaying the uploaded file to a specified post
                $query = $pdo->prepare('SELECT files.id, storage_name FROM files, post WHERE post_id = ? && post_id = post.id');
                $query->execute([$row['id']]);
                while($fetch = $query->fetch()){
            ?>
            <tr>
                <td><?php echo $fetch['storage_name']?></td>
                <?php if($client){ ?><td><a href="download.php?file_id=<?php echo $fetch['id']?>" class="btn btn-primary">Download</a></td><?php } ?>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>


        <hr>

    <?php } ?>

    




</body>
</html>

