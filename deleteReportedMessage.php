<?php
ob_start(); // need to keep this in as I was having issues with headers already sent. This function allows it to continue.

require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Delete message");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbConn = databaseConn::getConnection();
$messageID = $_GET['messageID'];

$sqlUpdate2 = "DELETE FROM bp_message WHERE messageID = '$messageID'";

$query3 = $dbConn->prepare($sqlUpdate2);

$query3->execute();

header("Location: admin-reported-messages.php");
