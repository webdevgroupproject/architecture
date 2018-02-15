<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');

$dbConn = databaseConn::getConnection();

$userID = isset($_REQUEST['userIdentification']) ? $_REQUEST['userIdentification']:null; //variables that are set using issets to check if the information has been set, otherwise pass null
$forename = isset($_REQUEST['forename']) ? $_REQUEST['forename']:null;
$surname = isset($_REQUEST['surname']) ? $_REQUEST['surname']:null;
$location = isset($_REQUEST['location']) ? $_REQUEST['location']:null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email']:null;
$overview = isset($_REQUEST['organOverview']) ? $_REQUEST['organOverview']:null;

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$location = filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$overview = filter_var($overview, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

trim($forename);
trim($surname);
trim($email);
trim($location);


$updateSQL = $dbConn->prepare("UPDATE bp_user SET forename='$forename', surname='$surname', email='$email', location='$location'WHERE userId = $userID");

$updateSQL->execute();

header("Location: profile.php");
