<?php
ob_start(); // need to keep this in as I was having issues with headers already sent. This function allows it to continue.

require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Suspend user");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbConn = databaseConn::getConnection();
$userID = $_GET['userId'];

// get users email address from users table
$sql = "SELECT email FROM bp_user where userId = $userID";
$result = $dbConn->prepare($sql);
$result->execute();
$userEmail = $result->fetchColumn();


$sql = "DELETE FROM bp_suspend WHERE userId = $userID ";

$query = $dbConn->prepare($sql);

$query->execute();

$sqlUpdate = "UPDATE bp_user set suspended = FALSE where userId = $userID";

$query2 = $dbConn->prepare($sqlUpdate);

$query2->execute();

echo "<p style='margin-left:25%; margin-top: 5%;'>User has been unsuspended. They will receive a email to confirm that they can use the website again.</p>";

$to = $userEmail;

$subject = 'Unsuspended account';

$message = "
    <html>
    <head>
      <title>Unsuspended user account</title>
    </head>
    <body>
      <p>Dear $userEmail, <br/> we are emailing you to let you know that your account has been unsuspended by admin staff at Blueprint.</p>
      <p>You can now re-use the website again. </p>
      <p>Kind regards, Blueprint</p>
    </body>
    </html>
    ";

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: $userEmail';
$headers[] = 'From: doNotReply@blueprint.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));


echo makePageFooter();