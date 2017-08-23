<?php

// User Tablec

// Include db connection
require('includes/connect.php');

// Select all users in a descending order with their ID
$sql = "SELECT * FROM wx_users ORDER BY id DESC";
$query = $pdo->prepare($sql);

// Execute
$query->execute();

?>

<?php include('header.php'); ?>

<?php

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    // User is not logged in. Redirect them back to the login page.
    header('Location: index.php');
    exit;
}

?>

                <article class="content responsive-tables-page">
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> WX-Alert Users</h3>
                                        </div>
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Business</th>
                                                            <th>Phone</th>
                                                            <th>Date</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                        
                                                        <?php
                                                        // Store Result
                                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $row['name']; ?></td>                                                    
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['business']; ?></td> 
                                                            <td><?php echo $row['phone']; ?></td>
                                                            <td class="center"><?php echo $row['date'] ?></td>
                                                            <td class="center"><a href="#"><i class=" fa fa-pencil" style="text-align:center;"></i></a>  <a href="#"><i class="fa fa-times" style="padding-left: 15px;"></i></a></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>



<?php include('footer.php'); ?>
