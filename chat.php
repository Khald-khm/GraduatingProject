<?php

require('connect.php');


session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if(isset($_GET['id']))
{
    $_SESSION['anotherUser'] = $_GET['id'];
}


// if($_SERVER["REQUEST_METHOD"] == "POST")
// {
//     if(isset($_POST['send']))
//     {
//         $stmt = $pdo->prepare('INSERT INTO `messages` (`creator_id`, `destination_id`, `message`, `created_at`) VALUES (?, ?, ?, ?)');
//         $stmt->execute([$_SESSION['id'], $_COOKIE['anotherUser'], $_POST['message'], date("Y-m-d H:i:s")]);
//         unset($_POST);
//         header("Location: chat.php" . '?id='.$_COOKIE['anotherUser']);
//     }

// }


// if($_SERVER["REQUEST_METHOD"] == "GET")
// {
    //$anotherUserId = $_GET['id'] ?? '' ;
    // echo $anotherUserId;
// }


// All the messages in the conversation
// $stmt = $pdo->prepare("SELECT * FROM messages WHERE messages.from=:id and messages.to=:ano");
// $stmt->execute(['id'=>$_SESSION['id'], 'ano'=>$_COOKIE['anotherUser']]); 
// $messages = $stmt->fetchAll();


// the user you are texting
$stmt = $pdo->prepare("SELECT username FROM user WHERE id = ?");
$stmt->execute([ $_SESSION['anotherUser']]);
$liveUser = $stmt->fetch();


// all the messages in the conversation
$stmt = $pdo->prepare("SELECT DISTINCT message, creator_id, destination_id, created_at FROM messages, user WHERE ((creator_id =:me AND destination_id =:him) OR (creator_id =:him AND destination_id =:me)) ORDER BY created_at");
$stmt->execute(['me' => $_SESSION['id'], 'him' => $_SESSION['anotherUser']]);
$allMessages = $stmt->fetchAll();


// select users you have conversations with 
$stmt = $pdo->prepare("SELECT DISTINCT username FROM user, messages WHERE (creator_id = user.id AND destination_id = ?) OR (creator_id = ? AND destination_id = user.id)");
$stmt->execute([$_SESSION['id'], $_SESSION['id']]);
$textedUser = $stmt->fetchAll();


// echo $liveUser['username'].'<br>';

// foreach($allMessages as $row)
// {
//     echo $row['message'].'<br>';
// }

// foreach($textedUser as $row)
// {
//     echo $row['username'];
// }


?>

















<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title-->
    <title>Chat</title>
    <!-- Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/apexcharts.css">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
</head>

<body>
    <!-- Preloader-->
    <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content-->
            <div class="header-content position-relative d-flex align-items-center justify-content-between">
                <!-- Chat User Info-->
                <div class="chat-user--info d-flex align-items-center">
                    <!-- Back Button-->
                    <div class="back-button"><a href="conversation.php"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
</svg></a></div>
                    <!-- User Thumbnail & Name-->
                    <div class="user-thumbnail-name"><img src="img/bg-img/2.jpg" alt="">
                        <div class="info ms-1">
                            <p><?php echo $liveUser['username'];?></p><span class="active-status">Active Now</span>
                            <!-- span.offline-status.text-muted Last actived 27m ago-->
                        </div>
                    </div>
                </div>
                <!-- Call & Video Wrapper-->
                <div class="call-video-wrapper d-flex align-items-center">
                    <!-- Video Icon-->
                    <div class="video-icon me-3"><a id="videoCallingButton" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175l3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
</svg></a></div>
                    <!-- Call Icon-->
                    <div class="call-icon me-3"><a id="callingButton" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a></div>
                    <!-- Info Icon-->
                    <div class="info-icon"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Calling Popup-->
    <div class="video-calling-popup-wrap" id="videoCallingPopup">
        <div class="video-calling-popup-body bg-overlay" style="background-image: url('img/icons/ACoding.png')">
            <!-- User Thumbnail-->
            <div class="user-thumbnail mb-3"><img src="img/icons/ACoding.png" alt=""></div>
            <!-- Video Icon-->
            <div class="video-icon d-block mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-camera-video text-white" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175l3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
</svg>
            </div>
            <h6 class="mb-5 text-white">AC is video calling...</h6>
            <!-- Button Group-->
            <div class="button-group"><a class="btn btn-lg btn-danger btn-round me-3" id="videoCallDecline" href="#">Decline</a><a class="btn btn-lg btn-success btn-round ms-3" href="page-video-call.html">Accept</a></div>
        </div>
    </div>
    <!-- Calling Popup-->
    <div class="calling-popup-wrap" id="callingPopup">
        <div class="calling-popup-body bg-primary">
            <!-- User Thumbnail-->
            <div class="user-thumbnail mb-3"><img src="img/icons/ACoding.png" alt=""></div>
            <!-- Call Icon-->
            <div class="call-icon d-block mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-telephone text-white" viewBox="0 0 16 16">
<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg>
            </div>
            <h6 class="mb-5 text-white">AC is calling...</h6>
            <!-- Button Group-->
            <div class="button-group"><a class="btn btn-lg btn-danger btn-round me-3" id="callDecline" href="#">Decline</a><a class="btn btn-lg btn-success btn-round ms-3" href="#">Accept</a></div>
        </div>
    </div>
    <div class="page-content-wrapper py-3 chat-wrapper">
        <div class="container">
            <div class="chat-content-wrap" id="allMessages">


                
            </div>
        </div>
    </div>
    <div class="chat-footer">
        <div class="container h-100">
            <div class="chat-footer-content h-100 d-flex align-items-center">
                <!-- <form action="chat.php? <?php // echo 'id='.$_COOKIE['anotherUser'];?>" method="post"> -->
                    <!-- Message-->
                    <input class="form-control" id="messageField" type="text" name="message" placeholder="Type here...">
                    <!-- Emoji-->
                    <button class="btn btn-emoji mx-2" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
</svg>
            </button>
                    <!-- Add File-->
                    <div class="dropup me-2">
                        <button class="btn btn-add-file dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>
              </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="bi bi-files"></i>Files</a></li>
                            <li><a href="#"><i class="bi bi-mic"></i>Audio</a></li>
                            <li><a href="#"><i class="bi bi-file-earmark"></i>Document</a></li>
                            <li><a href="#"><i class="bi bi-file-bar-graph"></i>Pull</a></li>
                            <li><a href="#"><i class="bi bi-geo-alt"></i>Location</a></li>
                        </ul>
                    </div>
                    <!-- Send-->
                    <button class="btn btn-submit" onclick="sendMessage()" name="send"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cursor" viewBox="0 0 16 16" type="submit">
<path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
</svg>
            </button>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!-- All JavaScript Files-->

    <script>


        // $(document).ready(function () {

        //     // var scroll = setInterval(function(){ window.scrollBy(0,1000); }, 2000);
        // }


        function sendMessage() {
            var message = $("#messageField").val();
            $.ajax(
                {
                    type: 'POST',
                    data: {"message" : message},
                    // dataType: "html",
                    url: 'chatAjax.php',
                    success: function(data) {
                        // $('#ajaxTry').val(data);
                        console.log("success");
                        $("#messageField").val("");
                        // console.log(naming);
                        // $('#ajaxTry').html(data);

                    },
                    error: function() {
                        console.log("error");
                    }
                    
                }
            )
        }



        var interval = 1000;  // 1000 = 1 second, 3000 = 3 seconds
        function doAjax() {
                $.ajax({
                    type: 'POST',
                    url: 'allMessages.php',
                    // data: $(this).serialize(),
                    // dataType: 'string',
                    success: function (data) {
                            // $('#ajaxCalling').val(data);// first set the value
                            $('#allMessages').html(data);
                            // console.log(data);
                            console.log("hello");
                    },
                    complete: function (data) {
                            // Schedule the next
                            setTimeout(doAjax, interval);
                    }
            });
        }
        setTimeout(doAjax, interval);

    
        // Ajax function that doesn't reload the page when sending message
        // Don't forget to empty the field when success
        
    
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/default/internet-status.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/default/dark-mode-switch.js"></script>
    <script src="js/ion.rangeSlider.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/default/clipboard.js"></script>
    <!-- PWA-->
    <script src="js/pwa.js"></script>
</body>


</html>