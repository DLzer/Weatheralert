<?php

// User Table

// Start Session
session_start();

// Include db connection
require('includes/connect.php');

// Select all users in a descending order with their ID
$sql = "SELECT * FROM wx_alerts ORDER BY id DESC";
$query = $pdo->prepare($sql);

// Execute
$query->execute();

?>

<?php include('header.php'); ?>

                <article class="content responsive-tables-page">
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> WX-Alert History</h3>
                                        </div>
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Alert</th>
                                                            <th>Zones</th>
                                                            <th>Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    <?php
                                                        // Loop through rows and output as table data
                                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $row['date']; ?></td>
                                                            <td><?php echo $row['type']; ?></td>
                                                            <td><?php echo $row['zones']; ?></td>
                                                            <td><?php echo $row['comments']; ?></td>    
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
