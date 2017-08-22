<?php

include_once('connect.php');

function secure_login() {
    $sql = mysqli_query($mysqli, "SELECT (id, email, password) FROM wx_users");
    $result = mysqli_query($mysqli, $sql);

    
}

?>