<?php
ob_start(); // need to keep this in as I was having issues with headers already sent. This function allows it to continue.

require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$dbConn = databaseConn::getConnection();
$userID = $_GET['userId'];
$sql = "DELETE FROM bp_user where userId = '$userID'";
$queryresult = $dbConn->prepare($sql);
$queryresult->execute();

$sqlEmail = "SELECT email FROM bp_user where userId = $userID";
$result2 = $dbConn->prepare($sqlEmail);
$result2->execute();
$userEmail = $result2->fetchColumn();

$to = $userEmail;

$subject = 'Account deleted';

$message = "
    <html>
    <head>
      <title>Suspended user account</title>
    </head>
    <body>
      <p>Dear $userEmail, <br/> We are emailing to let you know that admin staff from Blueprint website have deleted your account</p>
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
if ($queryresult) {
    header('Location: maintain-roles.php');
} else {
    echo "failed";
}