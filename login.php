<?php


require("connect.php");

// Initialize the session

session_start();
 
// Check if the user is already logged in, if yes then redirect him to its home page
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){

    if($_SESSION['group_id'] == 1)
    {
        header('location: BrowseJobs.php');
    }
    else if($_SESSION['group_id'] == 2)
    {
        header('location: BrowseFreelancers.php');
    }
    else if($_SESSION['group_id'] == 3)
    {
        header('location: BrowseJobsCompany.php');
    }
    else{
        header('location: Dashboard.php');
    }
    exit;
}

// The next with the previous code should be in every page to make sure there is a logging in

// else{
//     header('location: login.php');
// }
 

// Include config file
 
// Define variables and initialize with empty values
$username = $password = $group_id = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, group_id FROM user WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        $group_id = $row['group_id'];
                        if($password == $hashed_password){
                            // the previous condition was this (password_verify($password, $hashed_password)) but it doesn't worked
                            
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedIn"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;  
                            $_SESSION['group_id'] = $group_id;
                            
                            // Redirect user to welcome page
                            if($_SESSION['group_id']  == 1)
                            {
                                header('location: BrowseJobs.php');
                            }
                            else if($_SESSION['group_id']  == 2)
                            {
                                header('location: BrowseFreelancers.php');
                            }
                            else if($_SESSION['group_id']  == 3)
                            {
                                header('location: BrowseJobsCompany.php');
                            }
                            else{
                                header('location: Dashboard.php');
                            }
                        } 
                        else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>


<!--  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        // if(!empty($login_err)){
        //     echo '<div class="alert alert-danger">' . $login_err . '</div>';
        // }        
        ?>

        <form action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php //echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php //echo $username; ?>">
                <span class="invalid-feedback"><?php// echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php// echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php //echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html> -->




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
    <title>Log in</title>
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
    <!-- Back Button-->
    <div class="login-back-button">
    <a href="Beggining.php"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
        </svg></a>
    </div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                    <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
                    <!-- Register Form-->
                    <div class="register-form mt-4 px-4">
                        <h6 class="mb-3 text-center">Log in to Get Job.</h6>
                            <?php 
                                if(!empty($login_err)){
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                    // echo (!empty($username_err)) ? 'is-invalid' : 'no Error';
                                }  
                                else if(!empty($username_err)){
                                    echo '<div class="alert alert-danger">' . $username_err . '</div>';
                                    // echo (!empty($username_err)) ? 'is-invalid' : 'no Error';
                                }  
                                else if(!empty($password_err)){
                                    echo '<div class="alert alert-danger">' . $password_err . '</div>';
                                }      
                            ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <input class="form-control" value="<?php echo $username; ?>" type="text" placeholder="Username" name="username">
                            </div>
                            <div class="form-group">
                                <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Enter Password" name="password">
                            </div>
                            <button class="btn btn-primary w-100" type="submit" value="Login">Log In</button>
                        </form>
                    </div>
                    <!-- Login Meta-->
                    <div class="login-meta-data text-center"><a class="stretched-link forgot-password d-block mt-3 mb-1" href="forgetPassword.php">Forgot Password?</a>
                        <p class="mb-0">Didn't have an account? <a class="stretched-link" href="register.php">Register Now</a></p>
                    </div>
                </div>
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