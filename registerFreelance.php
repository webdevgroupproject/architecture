<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create account");
echo makeHeader();

$userID = $_SESSION['userId'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$passHint = $_SESSION['passHint']
$email = $_SESSION['Email'];
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$location = $_POST['location'];
$proOverview = $_POST['proOverview'];

$skillSets = $_POST['skillsets[]'];

trim($forename);
trim($surname);
trim($proOverview);

$forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS);
$surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS);
$location = filter_var($location, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS);
$proOverview = filter_var($proOverview, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_SANITIZE_SPECIAL_CHARS);

$stmt = $dbh->prepare('
  INSERT INTO bp_user(userID, skillTypeId) VALUES(:id, :skillID)
');

$stmt->bindValue(':id', $userID);
$stmt->bindParam(':skillID', $skillTypeId);

foreach($_POST["skillsets"] as $skillTypeId) $stmt->execute();


$dbConn = databaseConn::getConnection();
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$addUserSql = "INSERT INTO bp_users (forename, surname, email, username, password, overview)
                VALUES ('$userID', '$forename', '$surname', '$email', '$username', '$password', '$proOverview')";
// use exec() because no results are returned
$dbConn->exec($addUserSql);



echo "<h1>Success!</h1>" .
     "<div style='text-align: center;'>" .
     "<p>Your account has been created and added to our system! To view your profile page, press the button below</p>" .
     "<a href='profile.php' class='button'>Profile Page</a>" .
     "</div>";

echo makePageFooter();
