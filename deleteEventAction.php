<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
<title>Event canceled</title>
</head>
<body>
<h1>".$eventInfo->eventName." has been canceled</h1>
<p>Your ticket will no longer be valid.</p>
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
    $deleteSql = "DELETE FROM bp_events WHERE eventId='$eventId'";
    // use exec() because no results are returned
    $dbConn->exec($deleteSql);
    header('Location: events.php');

}
catch(PDOException $e) {
    echo $deleteSql . "<br>" . $e->getMessage();
}
