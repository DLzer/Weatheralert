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

        <?php

        require('includes/connect.php');

        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fullname']) && isset($_POST['phone'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $name = $_POST['fullname'];
        $business = $_POST['business'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO wx_users (date, username, password, email, name, business, phone) VALUES ( NOW(), '$username', '$password', '$email', '$name', '$business', '$phone')";

            if (mysqli_query($mysqli, $sql)) {
                $msg = "Registered Sussecfully";
                echo $msg;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo 'Please enter valid credentials';
        }

        ?>


<?php include('footer.php');?>