<?php
ob_start();
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();

$dbConn = databaseConn::getConnection();

$jobPostID = $_GET['jobPostID'];

$sql = "DELETE FROM bp_job_post where jobPostID = '$jobPostID'";
$queryresult = $dbConn->prepare($sql);
$queryresult->execute();
header('Location: profile.php');
exit;
