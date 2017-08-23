<?php

//Start the session
session_start();

// Inlcude database connection
require 'includes/connect.php';

// If our SUBMIT button exists, run the following
if(isset($_POST['submit'])) {

    // Retrieve the field values from our registration form
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

    // Add ERROR checking HERE

    // ^

    // Check if supplied username already exsits
    $sql = "SELECT COUNT (username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare(':username', $username);

    //Execute
    $stmt->execute();

    //Fetch the row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //If username already exists - kill script
    if($row['num'] > 0) {
        die('That username already exists');
    }

    //Hash the password
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

    //Prepare our INSERT statement
    $sql = "INSERT INTO wx_users (username, password, email, fullname, business, phone) VALUES (:username, :password, :email, :fullname, :business, :phone)";
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