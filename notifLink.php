<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

$notif = isset($_REQUEST['link']) ? $_REQUEST['link'] : null; //checks that the eventID is set/has been passed

$dbConn = databaseConn::getConnection();

checkUserType();

$userID = $_SESSION['userId'];

if ($notif == 'apply') {
  header("Location: profile.php");
} elseif ($notif == 'accepted') {
  header("Location: profile.php");
}
