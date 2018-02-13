<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');

$eventId = htmlspecialchars($_GET["eventid"]);
$userId = $_SESSION['userId'];

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $regSql ="DELETE FROM bp_event_signup
              WHERE eventId = '$eventId'
              AND userId = '$userId'";
    // use exec() because no results are returned
    $dbConn->exec($regSql);
    header("Location: eventPage.php?eventid=".$eventId);
    $eventSQL ="SELECT *
               FROM bp_events
               WHERE eventId = '$eventId'";
    $eventQuery = $dbConn->query($eventSQL);
    while($eventInfo = $eventQuery->fetchObject()){

        $to = "ross.al.brown92@gmail.com";
        $subject = "Blueprint ticket info";

        $message = "
<html>
<head>
<title>Your ticket info</title>
</head>
<body>
<h1>Sorry to see you go</h1>
<p>You have successfully dropped out of ".$eventInfo->eventName.", your ticket information will no longer be valid</p>
</body>
</html>
";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <blueprint@donotreply.com>';

        mail($to,$subject,$message,$headers);

    }
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
