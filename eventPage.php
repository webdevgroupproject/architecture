<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);

$dbConn = databaseConn::getConnection();

$indvEventSQL = "select *
             from bp_events
             WHERE eventId = '$eventId'
             order by eventDate";

$stmt = $dbConn->query($indvEventSQL);
// output data of each row
while ( $indvEvent = $stmt->fetchObject()) {

    echo "
    <div class=\"home-banner\">
        <div class=\"blueTitle\"><h1>" . $indvEvent->eventName . "</h1><p class='tagline'>$indvEvent->eventDate</p></div>
        <img src=\"images/event-img-1.jpeg\" alt=\"image of a blue print\">
    </div>
    <div class='infoBox'>
        <h1>Information on the event</h1>
        <p> . $indvEvent->eventName . Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href='registerAction.php?eventid=" . $indvEvent->eventId . "' class='button'>Register</a>
    </div>
    <div class='infoBox'><p>Location of the event</p></div>";
}


echo makePageFooter();
