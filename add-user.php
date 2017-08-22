<?php

ini_set('display_errors', 1);

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
    $fullname = !empty($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $business = !empty($_POST['business']) ? trim($_POST['business']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

    // Add ERROR checking HERE

    // ^

    // Check if supplied username already exsits
    $sql = "SELECT COUNT(username) AS num FROM wx_users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind Variable
    $stmt->bindValue(':username', $username);

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


<?php include('header.php');?>

        <article class="content forms-page">
            <section class="section">
                <div class="row sameheight-container">
                    <div class="col-md-6">
                        <div class="card card-block sameheight-item">
                            <div class="title-block">
                                <h3 class="title"> Add User </h3>
                            </div>
                            <form role="form" action="" method="POST">
                                <div class="form-group"> <label for="exampleInputUsername">Username</label> <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username"> </div>
                                <div class="form-group"> <label for="exampleInputPassword1">Password</label> <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"> </div>
                                <div class="form-group"> <label for="exampleInputUsername">Email</label> <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email"> </div>
                                <div class="form-group"> <label for="exampleInputName">Name</label> <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" name="fullname"> </div>
                                <div class="form-group"> <label for="exampleInputName">Business</label> <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Business" name="business"> </div>
                                <div class="form-group"> <label for="exampleInputName">Phone</label> <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Phone Number" name="phone"> </div>
                                <div class="form-group"> <button type="submit" class="btn btn-primary" name="submit">Submit</button> </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </article>

<?php include('footer.php');?>