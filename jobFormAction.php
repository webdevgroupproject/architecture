<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makeHeader();

$userID = $_SESSION['userId'];
$jobName = $_POST['jobName']; 
$workDesc = $_POST['workDesc'];
$jobLocation = $_POST['jobLocation'];
$payMethod = $_POST['payMethod'];
$budgetType = $_POST['budgetType'];
$jobDuration = $_POST['jobDuration'];

$jobName = filter_var($jobName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$workDesc = filter_var($workDesc, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$jobLocation = filter_var($jobLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$payMethod = filter_var($payMethod, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$budgetType = filter_var($budgetType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$jobDuration = filter_var($jobDuration, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$startDate = filter_var($startDate, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$endDate = filter_var($endDate, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$jobName = filter_var($jobName, FILTER_SANITIZE_SPECIAL_CHARS);
$workDesc = filter_var($workDesc, FILTER_SANITIZE_SPECIAL_CHARS);
$jobLocation = filter_var($jobLocation, FILTER_SANITIZE_SPECIAL_CHARS);
$payMethod = filter_var($payMethod, FILTER_SANITIZE_SPECIAL_CHARS);
$budgetType = filter_var($budgetType, FILTER_SANITIZE_SPECIAL_CHARS);
$jobDuration = filter_var($jobDuration, FILTER_SANITIZE_SPECIAL_CHARS);
$startDate = filter_var($startDate, FILTER_SANITIZE_SPECIAL_CHARS);
$endDate = filter_var($endDate, FILTER_SANITIZE_SPECIAL_CHARS);

trim($jobName);
trim($workDesc);
trim($jobLocation);
trim($payMethod);
trim($budgetType);
trim($jobDuration);
trim($startDate);
trim($endDate);

echo $jobName;

$dbConn = databaseConn::getConnection();
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$addJobSql = "INSERT INTO bp_job_post (userID, jobName, jobDesc, jobLoc, payMethod, budget, duration, startDate, endDate)
                VALUES ('$userID', '$jobName', '$workDesc', '$jobLocation', '$payMethod', '$budgetType', '$jobDuration', '$startDate', '$endDate' )";
// use exec() because no results are returned
$dbConn->exec($addJobSql);
header("Location: profile.php " );
