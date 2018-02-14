<?php 
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');

$acceptID = isset($_REQUEST['acceptID']) ? $_REQUEST['acceptID'] : null; //checks that the eventID is set/has been passed

$dbConn = databaseConn::getConnection();

$sql = $dbConn->prepare("DELETE FROM bp_job_accept WHERE jobAcceptID = $acceptID");

$sql->execute();

header("Location: profile.php");



