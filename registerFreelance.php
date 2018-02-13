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
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$location = $_POST['location'];
$proOverview = $_POST['proOverview'];
$skillSets = $_POST['skillsets'];

trim($forename);
trim($surname);
trim($proOverview);

$forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$location = filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$proOverview = filter_var($proOverview, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$dbConn = databaseConn::getConnection();

$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach($accType as $value) {
	$accTypeValue = $value; 
}

$addUserSql = "INSERT INTO bp_user(forename, surname, email, username, password, overview, userRole)
                VALUES ('$forename', '$surname', '$email', '$username', '$password', '$proOverview', '$accTypeValue')";
// use exec() because no results are returned
$dbConn->exec($addUserSql);

$getUserID = $dbConn->prepare("SELECT userId FROM bp_user ORDER BY userId DESC LIMIT 1"); 
$getUserID->execute();
$userID = $getUserID->fetchObject();

$stmt = $dbConn->prepare('
  INSERT INTO bp_skills(userId, skillTypeId) VALUES(:userID, :skillID)
');
$stmt->bindValue(':userID', $userID->userId);
$stmt->bindParam(':skillID', $skillTypeId);

foreach($_POST["skillsets"] as $skillTypeId) $stmt->execute();	



echo "<h1>Success!</h1>" .
     "<div style='text-align: center;'>" .
     "<p>Your account has been created and added to our system! To view your profile page, press the button below</p>" .
     "<a href='profile.php' class='button'>Profile Page</a>" .
     "</div>";

echo makePageFooter();
