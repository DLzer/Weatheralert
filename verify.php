<?php

ini_set('display_errors', 1);

//DB Connect
require_once('includes/connect.php');

$_SESSION['logged'] = false;

//If email and password have been input
if(isset($_POST['email']) && isset($_POST['password'])) {

  //Start a new session
  session_start();

  //Save form input as variables
  $email = $_POST['email'];
  $password = $_POST['password'];

  //Query the database for the corresponding email and password
  $query = $pdo->prepare('SELECT * FROM wx_users WHERE email=?');
  $query->execute([$email]);
  $query->bindValue(':email', $email, PDO::PARAM_STR);
  $query->bindValue(':password', $password, PDO::PARAM_STR);



  if( $query->execute() && $row = $query->fetch()) {

    if ($row['password'] == $password) {
      
      $_SESSION['email'] = $email;
      $_SESSION['logged'] = true;

      header('Location: dashboard.php');
    } else {
      $_SESSION['logged'] = false;
      header('Location: index.php');
    }
  }
}


?>