<?php
//Ross Brown
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
        <form method=\"get\" action=\"updateEventAction.php\" id='addEventForm'>
        <fieldset>
            <input style='display: none' type='text' value='$id' name='eventid' readonly>
            <label>Event name: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label>
                <input type=\"text\" name=\"name\" value='$name' class=\"form-control block\" placeholder=\"Please enter the name ov the event\"
                       data-validation=\"required\">
                       </fieldset>
            <fieldset>
                <legend><h2>Where</h2></legend>
                <label>Address line 1: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label>
                <input type=\"text\" name=\"address1\" value='$address1' class=\"form-control block\" placeholder=\"Please enter the first line of the address\"
                       data-validation=\"required\">
                <label>Address line 2: </label>
                <input type=\"text\" name=\"address2\" value='$address2'>
                <label>City: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label>
                <input type=\"text\" name=\"city\" value='$city' class=\"form-control block\" placeholder=\"Please enter the City\"
                       data-validation=\"required\">
                <label>Postcode: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label><br>
                <input style=\"width: 150px;\" type=\"text\" name=\"postcode\" value='$postcode' class=\"form-control block\" placeholder=\"Please enter a valid UK postcode\"
                       data-validation=\"required\"><br>
            </fieldset>
            <fieldset>
                <legend><h2>When</h2></legend>
                <label>Date: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label><br>
                <input style=\"width: 150px;\" type=\"date\" name=\"date\" value='$date' class=\"form-control block\" data-validation=\"required\"><br>
                <label>Time: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label><br>
                <input style=\"width: 150px;\" type=\"time\" name=\"time\" value='$time' class=\"form-control block\" data-validation=\"required\"><br>
            </fieldset>
            <fieldset>
                <legend><h2>Additional info</h2></legend>
                
                <label>Spaces: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label><br>
                <input style=\"width: 150px;\" min=\"1\" max=\"1000\" type=\"number\" name=\"spaces\" value='$spaces' class=\"form-control block\" placeholder=\"1\"
                       data-validation=\"required\"><br>
                <label>Event Information: <span style='color: #b50021; font-size: 22px;'>&#42;</span></label>
                <textarea style=\"max-width: 100%; width: 100%; margin-bottom: 1em;\" name=\"info\" id='info' class=\"form-control block\" placeholder=\"Please provide some information about the event\"
                       data-validation=\"required\">$info</textarea>
                <label>Image: </label>
                <input style=\"padding: 0;\" type=\"file\" name=\"image\">
            </fieldset>
            <div class=\"submit-wrap\">
            <input type=\"submit\" value=\"Update\" class=\"button\">
            <a href='deleteEventAction.php?eventid=$eventId' class='button'>Delete</a>
            </div>
        </form>
    </div>";
}
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $.validate({
        form : "#addEventForm"
    });
</script>

<?php
echo makePageFooter();
?>