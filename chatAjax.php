<?php

require('connect.php');

session_start();


if(isset($_POST['message']))
    {
        $stmt = $pdo->prepare('INSERT INTO `messages` (`creator_id`, `destination_id`, `message`, `created_at`) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_SESSION['id'], $_SESSION['anotherUser'], $_POST['message'], date("Y-m-d H:i:s")]);
        // unset($_POST);
        // header("Location: chat.php" . '?id='.$_SESSION['anotherUser']);
    }





?>