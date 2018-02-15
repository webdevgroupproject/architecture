<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

$jobPostID = isset($_REQUEST['jobID']) ? $_REQUEST['jobID'] : null; //checks that the eventID is set/has been passed

$dbConn = databaseConn::getConnection();

checkUserType();

$userID = $_SESSION['userId'];

$sql = $dbConn->prepare("INSERT bp_job_accept(jobPostID, userId, dateAccepted) VALUES ('$jobPostID', '$userID', now())");

$sql->execute();


$notifINST = "INSERT INTO bp_notification (userID, link, time, date, markRead)
VALUES ($userID, 'apply', now(), now(), '0')";
echo "$notifINST";
echo "$link";
$queryresult = $dbConn->prepare($notifINST);
$queryresult->execute();

header("Location: profile.php");
