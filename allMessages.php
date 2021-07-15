<?php

require('connect.php');

session_start();


$stmt = $pdo->prepare("SELECT DISTINCT message, creator_id, destination_id, created_at FROM messages, user WHERE ((creator_id =:me AND destination_id =:him) OR (creator_id =:him AND destination_id =:me)) ORDER BY created_at");
$stmt->execute(['me' => $_SESSION['id'], 'him' => $_SESSION['anotherUser']]);
$allMessages = $stmt->fetchAll();




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
    

<?php 
                    
                    foreach($allMessages as $row)
                    {

                        if($_SESSION['anotherUser'] == $row['creator_id'] && !empty($row['message']))
                        {
                            ?>
                        
                
                
                <!-- Single Chat Item-->
                <div class="single-chat-item">
                    <!-- User Avatar-->
                    <div class="user-avatar mt-1">
                        <!-- If the user avatar isn't available, will visible the first letter of the username.--><span class="name-first-letter">A</span><img src="img/bg-img/2.jpg" alt="">
                    </div>
                    <!-- User Message-->
                    <div class="user-message">
                        <div class="message-content">
                            <div class="single-message">
                                <p><?php /*if(!empty($row['message'])){*/echo $row['message'];/*}else{exit()}*/?></p>
                            </div>
                            <!-- Options-->
                            <div class="dropstart">
                                <button class="btn btn-options dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="bi bi-reply"></i>Reply</a></li>
                                    <li><a href="#"><i class="bi bi-forward"></i>Forward</a></li>
                                    <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Time and Status-->
                        <div class="message-time-status">
                            <div class="sent-time">11:39 AM</div>
                        </div>
                    </div>
                </div>

                    <?php 
                    }
                    else if(!empty($row['message'])){
                        ?>
                    
                <!-- Single Chat Item-->
                <div class="single-chat-item outgoing">
                    <!-- User Avatar-->
                    <div class="user-avatar mt-1">
                        <!-- If the user avatar isn't available, will visible the first letter of the username.--><span class="name-first-letter">A</span><img src="img/bg-img/user3.png" alt="">
                    </div>
                    <!-- User Message-->
                    <div class="user-message">
                        <div class="message-content">
                            <div class="single-message">
                                <p><?php echo $row['message'];?></p>
                            </div>
                            <!-- Options-->
                            <div class="dropstart">
                                <button class="btn btn-options dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="bi bi-reply"></i>Reply</a></li>
                                    <li><a href="#"><i class="bi bi-forward"></i>Forward</a></li>
                                    <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Time and Status-->
                        <div class="message-time-status">
                            <div class="sent-time">11:46 AM</div>
                            <div class="sent-status seen"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                   <?php }

                 } ?>
                



</body>
</html>