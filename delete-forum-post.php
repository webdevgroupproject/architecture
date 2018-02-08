<?php
ob_start();
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Delete forum post");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbConn = databaseConn::getConnection();

$messageID = $_GET['threadMessId'];


$sqlUpdate2 = "DELETE FROM bp_thread_message WHERE threadMessId = '$messageID'";

$query3 = $dbConn->prepare($sqlUpdate2);

$query3->execute();

header("Location: admin-reported-forum-posts.php");


echo makePageFooter();