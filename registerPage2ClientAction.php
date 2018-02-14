<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create account");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION['regUsername'];
$password = $_SESSION['password'];
$passHint = $_SESSION['passHint'];
$accType = $_SESSION['accType'];
$email = $_SESSION['email'];
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$location = $_POST['location'];
$organName = $_POST['organName'];
$organOverview = $_POST['organOverview'];
$webLink = $_POST['webLink'];
$image = $_POST['image'];

$forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$location = filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$organName = filter_var($organName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$organOverview = filter_var($organOverview, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$webLink = filter_var($webLink, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

// $forename = filter_var($forename, FILTER_SANITIZE_SPECIAL_CHARS);
// $surname = filter_var($surname, FILTER_SANITIZE_SPECIAL_CHARS);
// $location = filter_var($location, FILTER_SANITIZE_SPECIAL_CHARS);
// $organName = filter_var($organName, FILTER_SANITIZE_SPECIAL_CHARS);
// $organOverview = filter_var($organOverview, FILTER_SANITIZE_SPECIAL_CHARS);
// $webLink = filter_var($webLink, FILTER_SANITIZE_SPECIAL_CHARS);

trim($forename);
trim($surname);
trim($webLink);


$dbConn = databaseConn::getConnection();

$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach ($accType as $value) {
  $accTypeValue = $value;
}

$addUserSql = "INSERT INTO bp_user(forename, surname, email, username, password, overview, organisation, websiteLink, userRole, image)
                VALUES ('$forename', '$surname', '$email', '$username', '$password', '$organOverview', '$organName', '$webLink', '$accTypeValue', '$image')";
// use exec() because no results are returned
$dbConn->exec($addUserSql);

$getUserID = $dbConn->prepare("SELECT userId FROM bp_user ORDER BY userId DESC LIMIT 1");
$getUserID->execute();
$userID = $getUserID->fetchObject();

echo "<h1>Success!</h1>" .
     "<div id=\"jobConfirmContent\">" .
     "<p>Your account has been successfully created.</p>" .
     "<a href=\"accountType.php\" class=\"button\">Choose Account Type</a>" .
     "</div>";

echo makePageFooter();
