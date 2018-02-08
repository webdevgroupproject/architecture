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
$messageID = $_GET['messageID'];

// get date
$suspendEndDate = isset($_REQUEST["date"]) ? $_REQUEST["date"] : null;
// get reason
$reason = isset($_REQUEST["reason"]) ? $_REQUEST["reason"] : null;


// get users email address from users table
$sql = "SELECT email FROM bp_user where userId = $userID";
$result = $dbConn->prepare($sql);
$result->execute();
$userEmail = $result->fetchColumn();



//validate the inputs
$errors = array();

if (empty($suspendEndDate)) {
    $errors[] = "You have not entered a suspension end date";
}

if (empty($reason)) {
    $errors[] = "You have not entered a reason for the suspension";
}

if (!empty($errors)) {
    echo"<div class=\"ErrorMessages\">";
    echo"<b>The following errors occurred:</b> ";
    foreach ($errors as $currentError) {
        echo '<li>'.$currentError.'</li>';
    }
    echo"</div>";
} else {
    $suspendEndDate = filter_var($suspendEndDate, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $reason = filter_var($reason, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $suspendEndDate = filter_var($suspendEndDate, FILTER_SANITIZE_SPECIAL_CHARS);
    $reason = filter_var($reason, FILTER_SANITIZE_SPECIAL_CHARS);

    trim($suspendEndDate);
    trim($reason);

    $sql = "INSERT INTO bp_suspend (userId, suspendDate, reason) VALUES ('$userID','$suspendEndDate','$reason')";

    $query = $dbConn->prepare($sql);

    $query->execute();

    $sqlUpdate = "UPDATE bp_user set suspended = true where userId = '$userID'";

    $query2 = $dbConn->prepare($sqlUpdate);

    $query2->execute();


    $sqlUpdate2 = "DELETE FROM bp_message WHERE messageID = '$messageID'";

    $query3 = $dbConn->prepare($sqlUpdate2);

    $query3->execute();

    echo "User has been suspended. They will receive a email to confirm the reasons for their suspension and when they will be able to use the website again";

    $to = $userEmail;

    $subject = 'Blueprint suspension';

    $message = "
    <html>
    <head>
      <title>Suspended user account</title>
    </head>
    <body>
      <p>Dear $userEmail, <br/> we are emailing you to let you know that your account has been suspended by admin staff at Blueprint.</p>
      <p>The reasons for your suspension are <b>$reason.</b></p>
      <p>You will be able to log back into your account after the: <b>$suspendEndDate</b>.</p>
      <p>If you would like any more information regarding your suspension, please email suspensions@blueprint.com.</p>
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

}

echo makePageFooter();