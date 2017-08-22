<?php

include_once 'connect.php';

function getUsernamePass($db) {
$stmt = $db->prepare("SELECT email, password FROM wx_users WHERE email=? ");
$stmt->execute(array($email, $password));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

try {
    getUsernamePass($db);
} catch(PDOException $ex) {
    echo "An Error occured!";
}

?>