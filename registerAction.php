<?php
//Ross Brown
ob_start();
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
    $eventSQL ="SELECT *
               FROM bp_events
               WHERE eventId = '$eventId'";
    $eventQuery = $dbConn->query($eventSQL);
    // code to get event info and send in an email along with call to function that generates random string
    while($eventInfo = $eventQuery->fetchObject()){
        $to = "ross.al.brown92@gmail.com";
        $subject = "Blueprint ticket info";
        $message = "<html>
                        <head>
                            <title>Your ticket info</title>
                        </head>
                        <body>
                            <h1>Your ticket information</h1>
                            <p>You have successfully registered for ".$eventInfo->eventName."</p>
                            <p>Your ticket number is <strong>".generateRandomString()."</strong></p>
                        </body>
                    </html>";
        // set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <blueprint@donotreply.com>';
        // send the message
        mail($to,$subject,$message,$headers);
    }
    //send back to event info
    header("Location: eventPage.php?eventid=".$eventId);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

echo makePageFooter();
