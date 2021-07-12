<?php

require('connect.php');

session_start();

if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if($_SESSION['group_id'] != 1)
    {
        header('location: login.php');
    }

$skillsArr = [];

//                                  Important
// remember that the client has to pay after publishing a post to make it display it for freelancers
// remember that too if post status is done you shouldn't display it for freelancers

$stmt = $pdo->prepare("SELECT username, post.id, title, post.description, cost, post.start_date, post.skills, status FROM post, user WHERE client_id = user.id");
// if user choose from links aside
if(isset($_GET['link']))
{
    $link = $_GET['link'];

    $stmt = $db->prepare("SELECT username, post.id, title, post.description, cost, post.start_date, post.skills, status, paid_status FROM post, user WHERE client_id = user.id AND lower(category) =lower('$link')");
}

// if(isset($_GET['']))


$stmt->execute(); 
$posts = $stmt->fetchAll();




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
    <title>Browse Jobs</title>
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


    </div>
    <div class="page-content-wrapper py-3">
        <!-- Pagination-->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card">
                    <div class="card-body p-2">
                        <!-- Page Title-->
                        <div class="page-heading">
                            <h6 class="mb-0">Browse Jobs</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between"><small class="ms-1">Showing 6 of 31</small>
                            <form action="#">
                                <label for="site-search">Search the site:</label>
                                <input type="search" id="site-search" name="q" aria-label="Search through site content">

                                <button type="submit" name="">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Products-->
        <div class="top-products-area product-list-wrap">
            <div class="container">
                <div class="row g-3">
                    <!-- Single Top Product Card-->
                    <div class="col-12">

                    <?php 
                        
                        foreach ($posts as $row) {
                            
                            

                ?>

                        <div class="card single-product-card">
                            <div class="blog-body">
                                <h5 class="blog-title"><a href="blog-single.html"><?php echo $row['title'];?>.</a></h5>
                                <a href="#" class="blog-author mr-3"><i class="far fa-user mr-2"></i><?php echo $row['username'];?></a>
                                <!-- <a href="#" class="blog-date"><i class="far fa-clock mr-2"></i>July 15</a> -->
                                <p class="blog-text">
                                    <?php echo $row['description'];?>
                                </p>

                                <!-- we need skills for posts, end, start date and username-->


                                <a href="blog-single.html" class="default-link"><?php echo $row['cost'];?><i class="fa fa-arrow-right"></i></a>
                                <a href="postAndProposals.php?<?php echo 'id='.$row['id'];?>">Make a Proposal</a>
                            </div>
                        </div>

                        <?php } ?>
                    </div>


                </div>
                <!-- Footer Nav-->
                <div class="footer-nav-area" id="footerNav">
                    <div class="container px-0">
                        <!-- Paste your Footer Content from here-->
                        <!-- Footer Content-->
                        <div class="footer-nav position-relative">
                            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                                <li class="active"><a href="page-home.html"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
</svg><span>Home</span></a></li>
                                <li><a href="pages.html"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-collection" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
</svg><span>Pages</span></a></li>
                                <li><a href="elements.html"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-folder2-open" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg><span>Elements</span></a></li>
                                <li><a href="page-chat-users.html"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
<path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
<path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg><span>Chat</span></a></li>
                                <li><a href="settings.html"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
<path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
</svg><span>Settings</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- All JavaScript Files-->
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