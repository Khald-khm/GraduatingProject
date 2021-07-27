<?php


require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}

if(isset($_GET['id']))
{
    $postId = $_GET['id'];
}




// post information

$stmt = $pdo->prepare('SELECT username, user.id, post.id, client_id, freelancer_id, paid_status, title, post.description, cost, DATE_FORMAT(post.start_date, "%m/%d/%Y") start_date, post.skills, status FROM post, user WHERE post.id = ? AND client_id = user.id');
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
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>GetJob - ui - proposals</title>
    <meta name="description" content="Bolby - Portfolio/CV/Resume HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="proposal/css/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="proposal/css/all.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="proposal/css/simple-line-icons.css" type="text/css" media="all">
    <link rel="stylesheet" href="proposal/css/slick.css" type="text/css" media="all">
    <link rel="stylesheet" href="proposal/css/animate.css" type="text/css" media="all">
    <link rel="stylesheet" href="proposal/css/magnific-popup.css" type="text/css" media="all">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/apexcharts.css">
    <link rel="manifest" href="manifest.json">

    <link rel="stylesheet" href="proposal/css/style.css" type="text/css" media="all">


</head>

<body>



    





    <div class="pl-5 pt-4">
        <a href="login.php" class=""> <i class="fa fa-angle-left" style="font-size: 40px;"></i> </a>
    </div>

    <div class="container">

        <div class=" tocard col-md-6 px-md-1 my-4 my-md-8">

        
            <!-- price item recommended-->
            <div class="price-item bg-white rounded shadow-dark text-center best">

                
                <!-- <img src="images/price-2.svg" alt="Premium" /> -->
                <h2 class="plan"><?php echo $post['title'].'</br>';?></h2>
                <h6 class="plan"><?php echo $post['username'].'</br>';?><h6>
                <p><?php echo $post['description'].'</br>'; ?></p>
                <p><?php echo $post['start_date'].'</br>'; ?></p>
                <?php if($_SESSION["id"] == $post["client_id"] && $_SESSION['group_id'] == 2) 
                { 
                    ($post['paid_status'] == 1) ? $res = "Yes" : $res = "No";
                    ?>
                <p><?php echo "Paid = " . $res; ?> </p>
                <?php } ?>
                <p>
                    <?php 
                        foreach($skillArr as $row)
                        {
                            echo $row.' ';
                        }
                    ?>
                </p>
                <h3 class="price"><em>$</em><?php echo $post['cost'].'</br>'; ?><span></span></h3>
                <!-- <a href="#" class="btn btn-default">Get Started</a> -->
            </div>
        </div>
    </div>

    <!-- section about -->
    <section id="about">

        <div class="container">

            <!-- section title -->
            <h2 class="section-title wow fadeInUp">proposals</h2>

            <div class="spacer" data-height="60"></div>

            <div class="row d-flex align-items-center">

                <?php 

                    foreach($proposal as $row)
                    {
                        
                        
                        
                ?>

                <div class="col-md-3 p-3">
                    <div class="text-center text-md-left d-flex flex-column align-items-center">
                        <!-- avatar image -->
                        <img src="ui-c\img\bg-img\user1.png" alt="Bolby" class="w-50" />
                        <h6><a href="profile.php?id=<?php echo $row['id'];?>" class=""><?php echo $row['username'];?></a></h6>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-9 triangle-left-md triangle-top-sm">
                    <div class="rounded bg-white shadow-dark padding-30">
                        <div class="row">
                            <div class="col-md-6 ">
                                <!-- about text -->
                                <p><?php echo $row['description']; ?></p>


                            </div>

                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
            <!-- row end -->





        </div>

        <?php

            if($_SESSION['group_id'] == 1)
            {
        ?>
    </section>



    <!-- section contact -->
    <hr class="new2">
    <section id="contact">

        <div class="container">

            <!-- section title -->
            <h2 class="section-title wow fadeInUp">Add A Comment</h2>

            <div class="spacer" data-height="60"></div>

            <div class="row">

                <div class="col-md-4">
                    <!-- contact info -->
                    <div class="contact-info">
                        <h3 class="wow fadeInUp">You can add a comment to apply for the application</h3>
                        <p class="wow fadeInUp"> Add A Comment Now</p>
                    </div>
                </div>

                <div class="col-md-8">

                    
                    <!-- Contact Form -->
                    <form id="contact-form" class="contact-form mt-6" method="post" action="">

                        <div class="messages"></div>

                        <div class="row">






                            <div class="column col-md-12">
                                <!-- Message textarea -->
                                <div class="form-group">
                                    <textarea name="proposal" id="InputMessage" class="form-control" rows="5" placeholder="Add Your Proposal..." required="required" data-error="Message is required."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="makeBid" id="submit" value="Submit" class="btn btn-default">Add A Comment</button>
                        <!-- Send Button -->

                    </form>
                    <!-- Contact Form end -->

                    <?php } ?>
                </div>

            </div>

        </div>


        


    </section>

    <div class="spacer" data-height="96"></div>


    

    <!-- Go to top button -->
    <a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- SCRIPTS -->
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/infinite-scroll.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/validator.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/morphext.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/custom.js"></script>


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