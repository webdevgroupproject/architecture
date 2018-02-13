<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create account");
echo makeHeader();

$username = $_SESSION['regUsername'];
$password = $_SESSION['password'];
$passHint = $_SESSION['passHint'];
$accType = $_SESSION['accType'];
$email = $_SESSION['email'];
$forename = $_SESSION['forename'];
$surname = $_POST['surname'];
$location = $_POST['location'];
$organName = $_POST['organName'];
$organOverview = $_POST['organOverview'];
$webLink = $_POST['webLink'];

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
trim($organOverview);

$dbConn = databaseConn::getConnection();

$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$addUserSql = "INSERT INTO bp_user(forename, surname, email, username, password, overview, organisation, websiteLink, userRole)
                VALUES ('$forename', '$surname', '$email', '$username', '$password', '$organOverview', '$organName', '$webLink', '$accTypeValue')";
// use exec() because no results are returned
$dbConn->exec($addJobSql);

$getUserID = $dbConn->prepare("SELECT userId FROM bp_user ORDER BY userId DESC LIMIT 1");
$getUserID->execute();
$userID = $getUserID->fetchObject();

header ('location: jobPostConfirm.php');

echo "<h1>Success!</h1>" .
     "<div id=\"jobConfirmContent\">" .
     "<p>Your job has been successfully posted for others to see. You can now edit and review your posting from your profile page.</p>" .
     "<a href=\"profile.php\" class=\"button\">Return to your profile</a>" .
     "</div>";

echo makePageFooter();
