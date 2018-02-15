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

$addUserSql = "INSERT INTO bp_user(forename, surname, email, username, password, overview, organisation, websiteLink, userRole, image, location)
                VALUES ('$forename', '$surname', '$email', '$username', '$password', '$organOverview', '$organName', '$webLink', '$accTypeValue', '$image','$location')";
// use exec() because no results are returned
$dbConn->exec($addUserSql);

$getUserID = $dbConn->prepare("SELECT userId FROM bp_user ORDER BY userId DESC LIMIT 1");
$getUserID->execute();
$userID = $getUserID->fetchObject();

?>

<h1>You have been registered!	</h1>

<link href='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css'
          rel='stylesheet' type='text/css'/>
<h2 style='text-align: center;'>Choose your Account Type</h2>

<div class='form-container'>
    <form id='choices' name='choices' method='post' action='cardDetails.php'>
        <div class='radio-group'>
            <input type='radio' id='option-one' name='selector[]' value='option-one' onfocus='freeUser()'>
            <label for='option-one' onclick='freeUser()'>Free</label>
            <input type='radio' id='option-two' name='selector[]' value='option-two' checked='checked' onfocus='freeUser()'>
            <label for='option-two' style='float:right;' onclick='proUser()'>Blueprint Pro</label>
        </div>
        <div class='submit-wrap'>
            <input type='submit' value='Next' class='button' name='accountTypeNext' style='width: 170px;'>
        </div>
    </form>
</div>

<style>

    input[type=radio] {
        position: absolute;
        visibility: hidden;
        display: none;
    }

    .radio-group {
        border: solid 2px #675f6b;
        display: inline-block;
        overflow: hidden;
        margin-left:15%;
    }

    label + input[type=radio] + label {
        border-left: none;
   }

   .radio-group label {
        width: 49%;
        color: #404040;
        display: inline-block;
        cursor: pointer;
        font-weight: bold;
        padding: 5px 20px;
        text-align: center;
   }

   .test {
     width: 50%;
     float: left;
   }

   .test label {
     float: left;
     width: 50%;
   }

   .test input {
     width: 75%;
     clear: both;
   }

</style>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js'></script>
<script>
    $.validate({
    	form : '#choices'
	});
	console.log(document.choices.action);

	function freeUser() {
        document.choices.action = 'login.php';
        console.log(document.choices.action);
    }

     function proUser() {
        document.choices.action = 'cardDetails.php';
        console.log(document.choices.action);
    }
</script>

<?php
echo makePageFooter();
