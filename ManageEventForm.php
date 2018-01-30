<?php
require_once ('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);
$dbConn = databaseConn::getConnection();
$eventSQL = "SELECT *
             FROM bp_events
             WHERE eventId = '$eventId'";
$eventQuery = $dbConn->query($eventSQL);
while ($event = $eventQuery->fetchObject()) {
    $id = $event->eventId;
    $date = $event->eventDate;
    $time = "$event->eventTime";
    $address1 = $event->eventPlace;
    $address2 = $event->eventAddress2;
    $city = $event->eventCity;
    $postcode = $event->eventPostcode;
    $spaces = $event->eventSpaces;
    $info = $event->eventInfo;
    $name = $event->eventName;
    echo "<h1>Manage $name</h1>
          <div class=\"form-container\">
        <form method=\"get\" action=\"updateEventAction.php\">
            <input style='display: none' type='text' value='$id' name='eventid' readonly>
            <fieldset>
                <legend>Where</legend>
                <label>Address line 1: </label>
                <input type=\"text\" name=\"address1\" value='$address1'>
                <label>Address line 2 (optional): </label>
                <input type=\"text\" name=\"address2\" value='$address2'>
                <label>City: </label>
                <input type=\"text\" name=\"city\" value='$city'>
                <label>Postcode: </label><br>
                <input style=\"width: 150px;\" type=\"text\" name=\"postcode\" value='$postcode'><br>
            </fieldset>
            <fieldset>
                <legend>When</legend>
                <label>Date: </label><br>
                <input style=\"width: 150px;\" type=\"date\" name=\"date\" value='$date'><br>
                <label>Time: </label><br>
                <input style=\"width: 150px;\" type=\"time\" name=\"time\" value='$time'><br>
            </fieldset>
            <fieldset>
                <legend>Additional info</legend>
                <label>Event name: </label>
                <input type=\"text\" name=\"name\" value='$name'>
                <label>Spaces: </label><br>
                <input style=\"width: 150px;\" type=\"number\" name=\"spaces\" value='$spaces'><br>
                <label>Event Information: </label>
                <textarea style=\"max-width: 100%; width: 100%; margin-bottom: 1em;\" name=\"info\" id='info'>$info</textarea>
                <label>Image: </label>
                <input type=\"file\" name=\"image\">
            </fieldset>
            <div class=\"submit-wrap\">
            <input type=\"submit\" value=\"Update\" class=\"button\">
            <a href='deleteEventAction.php?eventid=$eventId' class='button'>Delete</a>
            </div>
        </form>
    </div>";
}
echo makePageFooter();
?>