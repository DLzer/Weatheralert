<?php 

// Login 

// Display Errors - DEVELOPMENT ONLY
ini_set('display_errors', 1);

//Start Session
session_start();

//Include connection to db
require('includes/connect.php');

//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST["login"])){
    
    //Retrieve the field values from our login form.
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : null;
    $passwordAttempt = !empty($_POST["password"]) ? trim($_POST["password"]) : null;

    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, email, username, password FROM wx_users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        die('Could not find a user with that username!');

    } else {

        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION["user_id"] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION["logged_in"] = time();

            
            //Redirect to our protected page, which we called home.php
            header('Location: dashboard.php');
            
        } else {

            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
}
 
?>
