<?php

ini_set('display_errors', 1);

session_start();
require_once 'includes/class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
 $reg_user->redirect('dashboard.php');
}


if(isset($_POST['submit']))
{
 $uname = trim($_POST['txtuname']);
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 $code = md5(uniqid(rand()));
 
 $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
 $stmt->execute(array(":email_id"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($stmt->rowCount() > 0)
 {
  $msg = "
        <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry !</strong>  email allready exists , Please Try another one
     </div>
     ";
 }
 else
 {
  if($reg_user->register($uname,$email,$upass,$code))
  {   
   $id = $reg_user->lasdID();  
   $key = base64_encode($id);
   $id = $key;
   
   $message = "     
      Hello $uname,
      <br /><br />
      Welcome to Coding Cage!<br/>
      To complete your registration  please , just click following link<br/>
      <br /><br />
      <a href='http://www.SITE_URL.com/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
      <br /><br />
      Thanks,";
      
   $subject = "Confirm Registration";
      
  }
  else
  {
   echo "sorry , Query could no execute...";
  }  
 }
}
?>
       


<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
            }
        </script>
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> ModularAdmin </h1>
                    </header>
                    <div class="auth-content">
                        <p class="text-xs-center">SIGNUP TO GET INSTANT ACCESS</p>

                        <form id="signup-form" action="" method="POST" novalidate="">
                            <div class="form-group"> <label for="firstname">Username</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="text" class="form-control underlined" name="txtuname" id="firstname" placeholder="Enter Username" required=""> </div>
                                </div>
                            </div>
                            <div class="form-group"> <label for="email">Email</label> <input type="email" class="form-control underlined" name="txtemail" id="email" placeholder="Enter email address" required=""> </div>
                            <div class="form-group"> <label for="password">Password</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="textupass" id="password" placeholder="Enter password" required=""> </div>
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Re-type password" required=""> </div>
                                </div>
                            </div>
                            <div class="form-group"> <label for="agree">
            <input class="checkbox" name="agree" id="agree" type="checkbox" required=""> 
            <span>Agree the terms and <a href="#">policy</a></span>
          </label> </div>
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="submit">Sign Up</button> </div>
                            <div class="form-group">
                                <p class="text-muted text-xs-center">Already have an account? <a href="index.php">Login!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-xs-center"> <a href="index.php" class="btn btn-secondary rounded btn-sm">
      <i class="fa fa-arrow-left"></i> Back to dashboard
    </a> </div>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>

<?php include('footer.php'); ?>