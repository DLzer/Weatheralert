<?php

include_once 'psl-config.php';   // As functions.php is not included

try {
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $user, $passwd);
$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
     echo $e->getMessage();
}

?>

