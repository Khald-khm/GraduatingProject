<?php
// Include config file
require_once "connect.php";

session_start();


if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
{
    header('location: login.php');
}
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


 
    // Validate username
    if(isset($_POST['username']) && empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } 
    else if(!empty($_POST['username']))
    {

    
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM user WHERE username = :username";
            
            if($stmt = $pdo->prepare($sql)){

                 // Set parameters
                 $param_username = trim($_POST["username"]);

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
               
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }

    }
    
    // Validate password
    if(isset($_POST['password']) && empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    }
    else if(!empty($_POST['password']))
    {
        if(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have at least 6 characters.";
            $_POST = array();
            header('location: register.php');
        } else{
            $password = trim($_POST["password"]);
        }
    }
    

    
    // Validate confirm password
    if(isset($_POST['confirm_password']) && empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";    
        header('location: register.php');
    }
    else if(!empty($_POST['confirm_password']))
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
            $_POST = array();
            header('location: register.php');
        }
    }





    // Validate Skills field syntax (skill, skill....)
    if(!empty($_POST['skills']) && !preg_match('~^\w+(, \w+)*$~', $_POST['skills']))
    {
        $skillErr = "Wrong syntax";
        $_POST = array();
        header('location: register.php');
    }






    
    // Check input errors before inserting in database
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['location']) && !empty($_POST['group_id']) && !empty($_POST['skills']) && !empty($_POST['category']) && !empty($_POST['hourly_rate'])){

        $_SESSION['group_id'] = $_POST['group_id'];

        if($_POST['group_id'] == 1 && !empty($_POST['skills']) && !empty($_POST['hourly_rate']) && !empty($_POST['category']) && !empty($_POST['bio']))
        {
            
            $stmt = $pdo->prepare("INSERT INTO user(first_name, last_name, email, username, password, skills, bio, hourly_rate, location, category, join_date, group_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['skills'], $_POST['bio'], $_POST['hourly_rate'], $_POST['location'], $_POST['category'], date("Y-m-d H:i:s"), $_POST['group_id']]);
            
            $_SESSION['loggedIn'] = true;
            header('location: browseJobs.php');
        
        }

        else{
            $stmt = $pdo->prepare("INSERT INTO user(first_name, last_name, email, username, password, location, join_date, group_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['location'], date("Y-m-d H:i:s"), $_POST['group_id']]);

            $_SESSION['loggedIn'] = true;
            header('location: BrowseFreelancers.php');
        }
        // Prepare an insert statement
        // $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        // if($stmt = $pdo->prepare($sql)){
        //     // Bind variables to the prepared statement as parameters
        //     $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        //     $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
        //     // Set parameters
        //     $param_username = $username;
        //     $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
        //     // Attempt to execute the prepared statement
        //     if($stmt->execute()){

        //         $_SESSION['loggedIn'] = true;
        //         $_SESSION['group_id'] = $_POST['group_id'];
        //         // Redirect to login page
        //         header("location: login.php");
        //     } else{
        //         echo "Oops! Something went wrong. Please try again later.";
        //     }

        //     // Close statement
        //     unset($stmt);
        // }
    }

    // else 
    // {
    //     header('location: register.php');
    // }
    
    // Close connection
    // unset($pdo);
}
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
    <title>Register</title>
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
    <!-- <div class="internet-connection-status" id="internetStatus"></div> -->
    <!-- Back Button-->
    <div class="login-back-button"><a href="login.php"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
</svg></a></div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                    <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
                    <!-- Register Form-->
                    <div class="register-form mt-4 px-4">
                        <h6 class="mb-3 text-center">Register to continue to Get Job</h6>
                        <form action="" method="post">
                            <div class="form-group text-start mb-3">
                                <input class="form-control" type="text" placeholder="First Name" name="first_name">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control" type="text" placeholder="Last Name" name="last_name">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control" type="email" placeholder="Email Address" name="email">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control" type="text" placeholder="Username" name="username">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control input-psswd" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control input-psswd" type="password" placeholder="Confirm Password" name="confirm_password">
                            </div>
                            <div class="form-group text-start mb-3">
                                <input class="form-control" type="text" placeholder="Location" name="location">
                            </div>

                            <div class="radio" style="padding-bottom: 40px;">

                                <div class="radio__1" style="float:left; width:50%;">
                                    <input type="radio" id="radio-1" value="1" style="float: left;" checked onchange="displaySkill()" name="group_id">
                                    <label for="radio-1" style="float:left; padding-left: 15px;"> Freelancer </label>
                                </div>

                                <div class="radio__2" style="float:right; width:50%;">
                                    <input type="radio" id="radio-2" value="2" style="float: left;" onchange="displaySkill()" name="group_id">
                                    <label for="radio-2" style="float:left; padding-left: 15px;"> Client </label>
                                </div>

                            </div>

                            <div id="freeFields" style="padding-bottom: 15px;">

                                <div class="form-group text-start mb-3">
                                    <input class="form-control" type="text" placeholder="Skills" onclick="syntaxPop()" name="skills">
                                </div>

                                <div class="form-group text-start mb-3">
                                    <input class="form-control" type="text" placeholder="Hourly Rate" name="hourly_rate">
                                </div>

                                <div class="form-group text-start mb-3">
                                    <input class="form-control" type="text" placeholder="Category" name="category">
                                </div>

                                <div class="form-group text-start mb-3">
                                    <textarea class="form-control" placeholder="About You..." name="bio"></textarea>
                                </div>
                                

                            </div>


                            <script>
                                    
                                    var alerted = false;

                                    function displaySkill(){
                                        var skill = document.getElementById("freeFields");
                                        if(skill.style.display === "none"){
                                            skill.style.display = "block";
                                        
                                        }
                                        else{
                                            skill.style.display ="none";
                                        }
                                    }



                                    function syntaxPop(){
                                        
                                        if(alerted === false)
                                        {
                                            alert("should be in this syntax 'skill, skill, skill.....'");
                                            alerted = true;
                                        }
                                        else{
                                            exit();
                                        }
                                       
                                    }

                                    
                                </script>



                            <!-- <div class="form-check mb-3" style="width: 100%;">
                                <input class="form-check-input" id="checkedCheckbox" type="checkbox" value="" >
                                <label class="form-check-label text-muted fw-normal" for="checkedCheckbox" >I agree with the terms &amp; privacy policy.</label>
                            </div> -->
                            <button class="btn btn-primary w-100" type="submit">Register</button>

                        </form>
                    </div>

                    <!-- Login Meta-->
                    <div class="login-meta-data text-center">
                        <p class="mt-3 mb-0">Already have an account? <a class="stretched-link" href="login.php">Login</a></p>
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
    <script src="js/default/dark-mode-switch.js"></script>
    <!-- Password Strenght-->
    <script src="js/default/jquery.passwordstrength.js"></script>
    <script src="js/default/active.js"></script>
    <!-- PWA-->
    <script src="js/pwa.js"></script>
</body>

</html>