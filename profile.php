<?php


require('connect.php');

session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true)
{
    header('location: login.php');
}


if(isset($_GET['id']))
{
    $_COOKIE['userProfile'] = $_GET['id'];
}



if(isset($_POST['hiring']))
{

    
    $stmt = $pdo->prepare('SELECT id, title FROM post WHERE client_id = ? AND status = "available" LIMIT 1');
    $stmt->execute([$_SESSION['id']]);
    $postId = $stmt->fetch();

    $projectId = $postId["id"];

    if($postId->rowCount() == 1)
    {
        $show = true;
    }
    else
    {
        $show = false;
    }
    

    $stmt = $pdo->prepare('UPDATE post SET freelancer_id = ?, status = "in progress" WHERE id = ?');
    $stmt->execute([$_COOKIE['userProfile'], $projectId]);

    unset($_POST);
}



$stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
$stmt->execute([$_COOKIE['userProfile']]); 
$user = $stmt->fetch();

// for freelancers the jobs have bids , in progress and done 
if($user['group_id'] == 1)
{
    $client = false;

    $stmt = $pdo->prepare('SELECT id, title, description, status, cost FROM post WHERE freelancer_id = ?');
    $stmt->execute([$_COOKIE['userProfile']]);
    $projects = $stmt->fetchAll();
}


// for clients the posts had posted by it
else if($user['group_id'] == 2)
{
    $client = true;

    $stmt = $pdo->prepare('SELECT * FROM post WHERE client_id = ?');
    $stmt->execute([$_COOKIE['userProfile']]);
    $projects = $stmt->fetchAll();
}


// in the foreach for the user
$skillsArr = explode(", ", $user['skills']);

// to foreach all the skills




?>







<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>GetJob - Portfolio Freelancer/Client</title>
    <meta name="description" content="Bolby - Portfolio/CV/Resume HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="Portfolio/images/favicon.png">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="Portfolio/css/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/all.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/simple-line-icons.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/slick.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/animate.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/magnific-popup.css" type="text/css" media="all">
    <link rel="stylesheet" href="Portfolio/css/style.css" type="text/css" media="all">



</head>

<body>



    <!-- Preloader -->
    <div id="preloader" class="light">
        <div class="outer">
            <!-- Google Chrome -->
            <div class="infinityChrome">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Safari a	nd others -->
            <div class="infinity">
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
            <!-- Stuff -->
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="goo-outer">
			<defs>
				<filter id="goo">
					<feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
					<feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
					<feBlend in="SourceGraphic" in2="goo" />
				</filter>
			</defs>
		</svg>
        </div>
    </div>

    <!-- mobile header -->
    <header class="mobile-header-1 light">
        <div class="container">
            <!-- menu icon -->
            <div class="menu-icon d-inline-flex mr-4">
                <button>
				<span></span>
			</button>
            </div>
            <!-- logo image -->
            <div class="site-logo">
                <a href="index-light.html">
                    <img src="Portfolio/images/logo.png" alt="AC" />
                </a>
            </div>
        </div>
    </header>

    <!-- desktop header -->
    <header class="desktop-header-1 light d-flex align-items-start flex-column">

        <!-- logo image -->
        <!-- <div class="site-logo">
            <a href="index-light.html">
                <img src="images/logo.png" alt="AC" />
            </a>
        </div> -->

        <!-- main menu -->
        <nav>
            <ul class="vertical-menu scrollspy">
                <li class="active"><a href="#home"><i class="icon-home"></i>Home</a></li>
                <li><a href="#about"><i class="icon-user-following"></i>About</a></li>
                <?php if(!$client){ ?>    <li><a href="#services"><i class="icon-briefcase"></i>skills</a></li> <?php }?>
                <!-- <li><a href="#experience"><i class="icon-graduation"></i>Experience</a></li> -->
                <li><a href="#works"><i class="icon-layers"></i>Works</a></li>
                <!-- <li><a href="#blog"><i class="icon-note"></i>Blog</a></li> -->
                <li><a href="#contact"><i class="icon-bubbles"></i>Contact</a></li>
            </ul>
        </nav>

        <!-- site footer -->


    </header>

    <!-- main layout -->
    <main class="content">

        <!-- section home -->
        <section id="home" class="home d-flex light align-items-center">
            <div class="container">

                <!-- intro -->
                <div class="intro">
                    <!-- avatar image -->
                    <img src="Portfolio/images/avatar-1.svg" alt="Bolby" class="mb-4" />

                    <!-- info -->
                    <h1 class="mb-2 mt-0"><?php echo $user['first_name'] . " " . $user['last_name'];?></h1>
                    <span>I'm a <span class="text-rotating">UI/UX designer, Front-End developer, Photography lover</span></span>

                    <!-- social icons -->
                    <ul class="social-icons light list-inline mb-0 mt-4">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-behance"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-dribbble"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>

                    <!-- buttons -->

                    <?php 
                    if(!$client && $_SESSION['group_id'] == 2)
                    {
                        ?>
                    
                    <form action="" method="post">

                        <div class="mt-4">
                            <button type="submit" class="btn btn-default" name="hiring">Hire me</button>
                        </div>
                    
                    </form>

                    <?php } ?>
                    
                </div>

                <!-- scroll down mouse wheel -->
                <div class="scroll-down light">
                    <a href="#about" class="mouse-wrapper">
                        <span>Scroll Down</span>
                        <span class="mouse">
						<span class="wheel"></span>
                        </span>
                    </a>
                </div>

                <!-- parallax layers -->
                <div class="parallax" data-relative-input="true">

                    <svg width="27" height="29" data-depth="0.3" class="layer p1" xmlns="http://www.w3.org/2000/svg"><path d="M21.15625.60099c4.37954 3.67487 6.46544 9.40612 5.47254 15.03526-.9929 5.62915-4.91339 10.30141-10.2846 12.25672-5.37122 1.9553-11.3776.89631-15.75715-2.77856l2.05692-2.45134c3.50315 2.93948 8.3087 3.78663 12.60572 2.22284 4.297-1.5638 7.43381-5.30209 8.22768-9.80537.79387-4.50328-.8749-9.08872-4.37803-12.02821L21.15625.60099z" fill="#FFD15C" fill-rule="evenodd"/></svg>

                    <svg width="26" height="26" data-depth="0.2" class="layer p2" xmlns="http://www.w3.org/2000/svg"><path d="M13 3.3541L2.42705 24.5h21.1459L13 3.3541z" stroke="#FF4C60" stroke-width="3" fill="none" fill-rule="evenodd"/></svg>

                    <svg width="30" height="25" data-depth="0.3" class="layer p3" xmlns="http://www.w3.org/2000/svg"><path d="M.1436 8.9282C3.00213 3.97706 8.2841.92763 14.00013.92796c5.71605.00032 10.9981 3.04992 13.85641 8 2.8583 4.95007 2.8584 11.0491-.00014 16.00024l-2.77128-1.6c2.28651-3.96036 2.28631-8.84002.00011-12.8002-2.2862-3.96017-6.5124-6.40017-11.08513-6.4-4.57271.00018-8.79872 2.43984-11.08524 6.4002l-2.77128-1.6z" fill="#44D7B6" fill-rule="evenodd"/></svg>

                    <svg width="15" height="23" data-depth="0.6" class="layer p4" xmlns="http://www.w3.org/2000/svg"><rect transform="rotate(30 9.86603 10.13397)" x="7" width="3" height="25" rx="1.5" fill="#FFD15C" fill-rule="evenodd"/></svg>

                    <svg width="15" height="23" data-depth="0.2" class="layer p5" xmlns="http://www.w3.org/2000/svg"><rect transform="rotate(30 9.86603 10.13397)" x="7" width="3" height="25" rx="1.5" fill="#6C6CE5" fill-rule="evenodd"/></svg>

                    <svg width="49" height="17" data-depth="0.5" class="layer p6" xmlns="http://www.w3.org/2000/svg"><g fill="#FF4C60" fill-rule="evenodd"><path d="M.5 16.5c0-5.71709 2.3825-10.99895 6.25-13.8567 3.8675-2.85774 8.6325-2.85774 12.5 0C23.1175 5.50106 25.5 10.78292 25.5 16.5H23c0-4.57303-1.90625-8.79884-5-11.08535-3.09375-2.28652-6.90625-2.28652-10 0C4.90625 7.70116 3 11.92697 3 16.5H.5z"/><path d="M23.5 16.5c0-5.71709 2.3825-10.99895 6.25-13.8567 3.8675-2.85774 8.6325-2.85774 12.5 0C46.1175 5.50106 48.5 10.78292 48.5 16.5H46c0-4.57303-1.90625-8.79884-5-11.08535-3.09375-2.28652-6.90625-2.28652-10 0-3.09375 2.28651-5 6.51232-5 11.08535h-2.5z"/></g></svg>

                    <svg width="26" height="26" data-depth="0.4" class="layer p7" xmlns="http://www.w3.org/2000/svg"><path d="M13 22.6459L2.42705 1.5h21.1459L13 22.6459z" stroke="#FFD15C" stroke-width="3" fill="none" fill-rule="evenodd"/></svg>

                    <svg width="19" height="21" data-depth="0.3" class="layer p8" xmlns="http://www.w3.org/2000/svg"><rect transform="rotate(-40 6.25252 10.12626)" x="7" width="3" height="25" rx="1.5" fill="#6C6CE5" fill-rule="evenodd"/></svg>

                    <svg width="30" height="25" data-depth="0.3" data-depth-y="-1.30" class="layer p9" xmlns="http://www.w3.org/2000/svg"><path d="M29.8564 16.0718c-2.85854 4.95114-8.1405 8.00057-13.85654 8.00024-5.71605-.00032-10.9981-3.04992-13.85641-8-2.8583-4.95007-2.8584-11.0491.00014-16.00024l2.77128 1.6c-2.28651 3.96036-2.28631 8.84002-.00011 12.8002 2.2862 3.96017 6.5124 6.40017 11.08513 6.4 4.57271-.00018 8.79872-2.43984 11.08524-6.4002l2.77128 1.6z" fill="#6C6CE5" fill-rule="evenodd"/></svg>

                    <svg width="47" height="29" data-depth="0.2" class="layer p10" xmlns="http://www.w3.org/2000/svg"><g fill="#44D7B6" fill-rule="evenodd"><path d="M46.78878 17.19094c-1.95535 5.3723-6.00068 9.52077-10.61234 10.8834-4.61167 1.36265-9.0893-.26708-11.74616-4.27524-2.65686-4.00817-3.08917-9.78636-1.13381-15.15866l2.34923.85505c-1.56407 4.29724-1.2181 8.92018.90705 12.12693 2.12514 3.20674 5.70772 4.5107 9.39692 3.4202 3.68921-1.0905 6.92581-4.40949 8.48988-8.70673l2.34923.85505z"/><path d="M25.17585 9.32448c-1.95535 5.3723-6.00068 9.52077-10.61234 10.8834-4.61167 1.36264-9.0893-.26708-11.74616-4.27525C.16049 11.92447-.27182 6.14628 1.68354.77398l2.34923.85505c-1.56407 4.29724-1.2181 8.92018.90705 12.12692 2.12514 3.20675 5.70772 4.5107 9.39692 3.4202 3.68921-1.0905 6.92581-4.40948 8.48988-8.70672l2.34923.85505z"/></g></svg>

                    <svg width="33" height="20" data-depth="0.5" class="layer p11" xmlns="http://www.w3.org/2000/svg"><path d="M32.36774.34317c.99276 5.63023-1.09332 11.3614-5.47227 15.03536-4.37895 3.67396-10.3855 4.73307-15.75693 2.77837C5.76711 16.2022 1.84665 11.53014.8539 5.8999l3.15139-.55567c.7941 4.50356 3.93083 8.24147 8.22772 9.8056 4.29688 1.56413 9.10275.71673 12.60554-2.2227C28.34133 9.98771 30.01045 5.4024 29.21635.89884l3.15139-.55567z" fill="#FFD15C" fill-rule="evenodd"/></svg>

                </div>
            </div>

        </section>

        <!-- section about -->
        <section id="about">

            <div class="container">

                <!-- section title -->
                <h2 class="section-title wow fadeInUp">About Me</h2>

                <div class="spacer" data-height="60"></div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="text-center text-md-left">
                            <!-- avatar image -->
                            <img src="Portfolio/images/avatar-2.svg" alt="Bolby" />
                        </div>
                        <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                    </div>

                    <div class="col-md-9 triangle-left-md triangle-top-sm">
                        <div class="rounded bg-white shadow-dark padding-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- about text -->
                                    <p><?php echo $user['bio']; ?></p>
                                    <!-- <div class="mt-3">
                                        <a href="#" class="btn btn-default">My CV</a>
                                    </div> -->
                                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- row end -->

                <div class="spacer" data-height="70"></div>

                

            </div>


        </section>


        <?php

        if(!$client)
        {
            ?>
        

        <!-- section services -->
        <section id="services">

            <div class="container">

                <!-- section title -->
                <h2 class="section-title wow fadeInUp">skills</h2>

                <div class="spacer" data-height="60"></div>

                <div class="row">
                    
                    <?php

                    foreach($skillsArr as $skill)
                    {
                        

                    ?>


                    <div class="col-md-4">
                        <!-- service box -->
                        <div class="service-box rounded data-background padding-30 text-center text-light shadow-pink" data-color="#F97B8B">
                            <!-- <img src="Portfolio/images/service-1.svg" alt="UI/UX design" /> -->
                            <h3 class="mb-3 mt-0"><?php echo $skill; ?></h3>
                            <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetuer adipiscing elit aenean commodo ligula eget.</p> -->
                        </div>
                        <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                    </div>

                    <?php } ?>


                </div>

                

            </div>

        </section>


        <?php } ?>



        <!-- section works -->
        

        <!-- section prices -->
        <section id="works">

            <div class="container">

                <!-- section title -->
                <h2 class="section-title wow fadeIn">Projects</h2>

                <div class="spacer" data-height="60"></div>

                <div class="row">


                    <?php 

                    foreach($projects as $row)
                    {

                        ?>
                    

                    <div class="col-md-4 px-md-0 my-4 my-md-0">
                        <!-- price item recommended-->
                        <div class="price-item bg-white rounded shadow-dark text-center best">

                            <!-- <img src="Portfolio/images/price-2.svg" alt="Premium" /> -->
                            <h2 class="plan"><?php echo $row['title']; ?></h2>
                            <p><?php echo $row['description']; ?></p>
                            <p><?php echo $row['status']; ?> </p>
                            <h3 class="price"><em>$</em><?php echo $row['cost']; ?><span></span></h3>
                            <a href="#" class="btn btn-default">Get Started</a>
                        </div>
                    </div>

                    <?php } ?>

                </div>

            </div>

            </div>

        </section>


        

        <!-- section contact -->
        <section id="contact">

            <div class="container">

                <!-- section title -->
                <h2 class="section-title wow fadeInUp">Get In Touch</h2>

                <div class="spacer" data-height="60"></div>

                <div class="row">

                    <div class="col-md-4">
                        <!-- contact info -->
                        <div class="contact-info">
                            <h3 class="wow fadeInUp">Let's talk about everything!</h3>
                            <p class="wow fadeInUp">Don't like forms? </p>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <!-- Contact Form -->
                        
                        <!-- Contact Form end -->
                        <a href="chat.php?id=<?php echo $_COOKIE["userProfile"]; ?>" class="btn btn-default"> Go to Chat</a>
                    </div>

                </div>

            </div>

        </section>

        <div class="spacer" data-height="96"></div>

    </main>

    <!-- Go to top button -->
    <a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- SCRIPTS -->
    <script src="Portfolio/js/jquery-1.12.3.min.js"></script>
    <script src="Portfolio/js/jquery.easing.min.js"></script>
    <script src="Portfolio/js/jquery.waypoints.min.js"></script>
    <script src="Portfolio/js/jquery.counterup.min.js"></script>
    <script src="Portfolio/js/popper.min.js"></script>
    <script src="Portfolio/js/bootstrap.min.js"></script>
    <script src="Portfolio/js/isotope.pkgd.min.js"></script>
    <script src="Portfolio/js/infinite-scroll.min.js"></script>
    <script src="Portfolio/js/imagesloaded.pkgd.min.js"></script>
    <script src="Portfolio/js/slick.min.js"></script>
    <script src="Portfolio/js/contact.js"></script>
    <script src="Portfolio/js/validator.js"></script>
    <script src="Portfolio/js/wow.min.js"></script>
    <script src="Portfolio/js/morphext.min.js"></script>
    <script src="Portfolio/js/parallax.min.js"></script>
    <script src="Portfolio/js/jquery.magnific-popup.min.js"></script>
    <script src="Portfolio/js/custom.js"></script>

</body>

</html>