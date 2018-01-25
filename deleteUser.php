<?php
ob_start(); // need to keep this in as I was having issues with headers already sent. This function allows it to continue.

require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$dbConn = databaseConn::getConnection();
$userID = $_GET['userId'];
$sql = "DELETE FROM bp_user where userId = '$userID'";
$queryresult = $dbConn->prepare($sql);
$queryresult->execute();
if ($queryresult) {
    header('Location: maintain-roles.php');
} else {
    echo "failed";
}