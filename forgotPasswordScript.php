<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('scripts/functions.php');
require_once('classes/databaseConn.php');
echo startSession();

$dbConn = databaseConn::getConnection();

if (isset($_GET["email"]) && isset($_GET["token"])) {

    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
    $sql = $dbConn->prepare("SELECT userId from bp_user where email ='$email' and token = '$token'");
    $sql->execute();
    $results = $sql->rowCount();

    if ($results > 0) {
        header("Location: forgotPasswordReset.php");
    } else {
        echo "<p>You shouldn't be on this page</p>";
    }
} else {
    header("Location: login.php");
    exit();
}
