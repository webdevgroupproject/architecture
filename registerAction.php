<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);
$userId = $_SESSION['userId'];

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $regSql ="INSERT INTO bp_event_signup (eventId, userId)
               VALUES ($eventId, $userId)";
    // use exec() because no results are returned
    $dbConn->exec($regSql);

    $userSQL ="SELECT *
               FROM bp_user
               WHERE userId = '$userId'";
    $userQuery = $dbConn->query($userSQL);
    while($userInfo = $userQuery->fetchObject()){

//        $email = $userInfo->email;
//        $to      = $email;
//        $subject = 'Event registration';
//        $message = 'You have signed up for this event your ticket number is 100034abc';
//        $headers = 'From: donotreply@blueprint.com' . "\r\n" .
//            'Reply-To: donotreply@blueprint.com' . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();
//
//        mail($to, $subject, $message, $headers);

    }
    header("Location: eventPage.php?eventid=".$eventId);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

echo makePageFooter();
