<?php

// New Alert

// Display Errors -> DEVELOPMENT ONLY
ini_set('display_errors', 1);

// Inlcude Db connection
require_once 'includes/connect.php';

// Check that the SUBMIT variable exists
if(isset($_POST['send-alert'])) {

    // Check if the correct pin number was entered
    if(isset($_POST['pin']) && $_POST['pin'] == '5050') {

    // If SUBMIT exists collect the variables
    $alertType = $_POST['select_catalog'];
    $comments = $_POST['comments'];
    $zones = implode(',', $_POST['checkbox']);
    
    // Prepare your SQL statement
    $sql = "INSERT INTO wx_alerts (date, type, zones, comments) VALUES (now(), :alertType, :zones, :comments)";
    $stmt = $pdo->prepare($sql);

    // Bind Values
    $stmt->bindValue(':alertType' , $alertType);
    $stmt->bindValue(':zones', $zones);
    $stmt->bindValue(':comments' , $comments);

    // Execute 
    $result = $stmt->execute();

    // Send SMS using Twilio REST API
    require_once 'sendSms.php';

    } else {
        exit;
    }
}



?>


<?php
include('header.php');
?>

<?php

// Check for a current user_id and a logged_in variable
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    // User is not logged in. Redirect them back to the login page.
    header('Location: index.php');
    exit;
}

?>

                <article class="content forms-page">
                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title">Send New Alert </h3>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="form-group"><label class="control-label">Type of Alert</label> <select name="select_catalog" class="form-control">
							                <option>Tornado</option>
                                            <option>Blizzard</option>
                                            <option>Flood</option>
                                            <option>Hurricane</option>
                                            <option>Tropical Storm</option>
						                </select> </div>
                                        <div class="form-group"> <label class="control-label">Alert Zone</label>
                                        <div> <label>
                                            <input class="checkbox" type="checkbox" name="checkbox[]" value="1">
                                                <span>Zone 1</span>
                                                </label> </div>
                                                 <div> <label>
                                            <input class="checkbox" type="checkbox" name="checkbox[]" value="2">
                                                <span>Zone 2</span>
                                                </label> </div>
                                                <div> <label>
                                            <input class="checkbox" type="checkbox" name="checkbox[]" value="3">
                                                <span>Zone 3</span>
                                                </label> </div>
                                                <div> <label>
                                            <input class="checkbox" type="checkbox" name="checkbox[]" value="4">
                                                <span>Zone 4</span>
                                                </label> </div>
                                                <div> <label>
                                            <input class="checkbox" type="checkbox" name="checkbox[]" value="5">
                                                <span>Zone 5</span>
                                                </label> </div>
                                        </div>
                                        <div class="form-group"> <label class="control-label">Input PIN</label> <input type="password" class="form-control boxed" name="pin"> </div>
                                        <div class="form-group"> <label class="control-label">Alert Comments</label> <textarea rows="3" class="form-control boxed" name="comments"></textarea> </div>
                                        <div class="form-group"> <button type="submit" class="btn btn-primary" name="send-alert">Submit</button> </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </article>

<?php include('footer.php'); ?>