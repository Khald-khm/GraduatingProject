<?php


require('connect.php');

session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}



// for freelancer
// if(group_id = 1){}
$stmt = $pdo->prepare('SELECT * FROM post WHERE freelancer_id = ? AND lower(status) = "in progress";')
$stmt->execute([$_SESSION['id']]); 
$post = $stmt->fetchAll();





// you should also select the company that is having the project


// for client
// if(group_id = 2){}
$stmt = $pdo->prepare('SELECT * FROM post WHERE client_id = ? AND lower(status) = "in progress";')
$stmt->execute([$_SESSION['id']]); 
$post = $stmt->fetchAll();


// for transfer company
// I just don't know what is the name of the column we want instead of   freelancer_id
// if(group_id = 3){}
$stmt = $pdo->prepare('SELECT * FROM post WHERE company_id = ? AND lower(status) = "in progress";')
$stmt->execute([$_SESSION['id']]); 
$post = $stmt->fetchAll();






?>




// for uploading a files from freelancers

<form method="POST" action="upload.php" enctype="multipart/form-data">
                <div class="form-inline">
                    <input type="file" class="form-control" name="file" required="required"/>
                    <button class="btn btn-primary" name="upload"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                </div>
</form>
        



<?php
                    // for displaying the uploaded file to a specified post
                    $query = $pdo->prepare("SELECT * FROM files, post WHERE post_id = $row['post_id']");
                    $query->execute();
                    while($fetch = $query->fetch()){
                ?>
                <tr>
                    <td><?php echo $fetch['file']?></td>
                    <td><a href="download.php?file_id=<?php echo $fetch['file_id']?>" class="btn btn-primary">Download</a></td>
                </tr>
                <?php
                    }
                ?>