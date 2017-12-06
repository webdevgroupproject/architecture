<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$userType = checkUserType();
echo "<h1>Upcoming events</h1>
<div class='filterBar'>";

if ($userType == "admin"){
    echo "<a href='#' class='button' id='addEventButton'>Add an event</a>";
}

echo"</div>
<div class=\"images-container\">";
$dbConn = databaseConn::getConnection();

$eventSQL = 'select *
             from bp_events
             order by eventDate';

$stmt = $dbConn->query($eventSQL);
    // output data of each row
    while ( $event = $stmt->fetchObject()) {


      echo "<div class=\"imageThirdContain\">
            <a href=\"eventPage.php?eventid=" . $event->eventId . "\">
            <div class=\"image-with-text\">
              <img src=\"images/". $event->eventImage ."\" alt=\"image of a 3d model house\">
              <div class=\"attendance-info-banner\">
                <span class=\"number-attending\">9 attending</span>
                <span class=\"spaces-left\">11 spaces left</span>
              </div>
              <div class=\"image-text\">" . $event->eventName . "<p>" . $event->eventDate . " | " . $event->eventPlace . " | " . $event->eventTime . "</p>
              </div>
            </div>
            </a>
          </div>";
}
echo "  </div>";
echo makePageFooter();
