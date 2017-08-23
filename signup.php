<?php

ini_set('display_errors', 1);

// Inlcude database connection
require 'includes/connect.php';

// If our SUBMIT button exists, run the following
if(isset($_POST['sign-up'])) {

    // Retrieve the field values from our registration form
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $fullname = !empty($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $business = !empty($_POST['business']) ? trim($_POST['business']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

    //Hash the password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    //Prepare our INSERT statement
    $sql = "INSERT INTO wx_users (date, username, password, email, name, business, phone) VALUES (now(), :username, :password, :email, :fullname, :business, :phone)";
    $stmt = $pdo->prepare($sql);

    //Bind our variables
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':fullname', $fullname);
    $stmt->bindValue(':business', $business);
    $stmt->bindValue(':phone', $phone);

    //Execute the statement and insert the new account
    $result = $stmt->execute();

    //If the process is successful
    if($result) {
        //Create congratulations message
        echo 'New user successfully added!';
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
                     <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> WX Alert </h1>
             </header>
             <div class="auth-content">
                 <p class="text-xs-center">SIGNUP TO GET INSTANT ACCESS</p>

                 <form id="signup-form" action="" method="POST" novalidate="">
                     <div class="form-group"> <label for="firstname">Username</label>
                         <div class="row">
                             <div class="col-sm-6"> <input type="text" class="form-control underlined" name="username" id="firstname" placeholder="Enter Username" required=""> </div>
                         </div>
                     </div>
                     <div class="form-group"> <label for="firstname">Full Name</label>
                         <div class="row">
                             <div class="col-sm-6"> <input type="text" class="form-control underlined" name="fullname" id="firstname" placeholder="Full Name" required=""> </div>
                         </div>
                     </div><div class="form-group"> <label for="firstname">Business</label>
                         <div class="row">
                             <div class="col-sm-6"> <input type="text" class="form-control underlined" name="business" id="firstname" placeholder="Business" required=""> </div>
                         </div>
                     </div>
                     <div class="form-group"> <label for="firstname">Phone Number</label>
                         <div class="row">
                             <div class="col-sm-6"> <input type="text" class="form-control underlined" name="phone" id="firstname" placeholder="ex. 18005005555" required=""> </div>
                         </div>
                     </div>
                     <div class="form-group"> <label for="email">Email</label> <input type="email" class="form-control underlined" name="email" id="email" placeholder="Enter email address" required=""> </div>
                     <div class="form-group"> <label for="password">Password</label>
                         <div class="row">
                             <div class="col-sm-6"> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required="" name="password"> </div>
                             <div class="col-sm-6"> <input type="password" class="form-control underlined" name="password_confirm" id="retype_password" placeholder="Re-type password" required=""> </div>
                         </div>
                     </div>
                     <div class="form-group"> <label for="agree">
     <input class="checkbox" name="agree" id="agree" type="checkbox" required=""> 
     <span>Agree the terms and <a href="#">policy</a></span>
   </label> </div>
                     <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="sign-up">Sign Up</button> </div>
                     <div class="form-group">
                         <p class="text-muted text-xs-center">Already have an account? <a href="index.php">Login!</a></p>
                     </div>
                 </form>
             </div>
         </div>
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