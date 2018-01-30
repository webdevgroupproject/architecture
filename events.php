<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$searchCitySQL = 'SELECT DISTINCT eventCity
                  FROM bp_events';
echo "
<h1>Community events</h1>
<div class='filterBar'>
    <form id='orderEventsForm' action='#' onchange=\"sortBy(this . value)\">
		    <label>Choose a City: </label>
			<select class='dropdown' name=\"searchByCity\">
			<option value='none' selected>Choose a city</option>";

foreach ($dbConn->query($searchCitySQL) as $row) {
    echo"<option value='".$row['eventCity']."'>".$row['eventCity']."</option>";
}

			echo"</select>
    </form>";
    if ($userType == "admin"){
        echo "<a href='addEventForm.php' class='button' id='addEventButton'>Add an event</a>";
    };

$eventSQL = 'select *
             from bp_events
             order by eventDate';

$stmt = $dbConn->query($eventSQL);
    // output data of each row
    while ( $event = $stmt->fetchObject()) {
      $eventImage = $event->eventImage;
      $defaultImage = "defaultEventImg.jpeg";
      $date = $event->eventDate;
      $dateString = strtotime($date);
      $formatMonth = date("M", $dateString);
      $formatDay = date("d", $dateString);
      $formatDate = date("M d Y", $dateString);
      $time = "$event->eventTime";
      $timeString = strtotime($time);
      $formatTime = date("h:ia", $timeString);
      echo "

</div>
<div class=\"images - container\">
        <div class='event-contain'>
            <div class='event-date-contain'><p>$formatMonth</p><p>$formatDay</p></div>
            <div class='event-img-contain'><img src=\"images /";echo $eventImage;echo"\" alt =\"Event image\" ></div>   
            <div class='event-info-contain'>
                <h2>$event->eventName</h2>
                <p>$event->eventPlace, $formatTime</p>
                <a class=\"button\" href=\"eventPage.php?eventid=" . $event->eventId . "\">Find out more</a>";
if ($userType == "admin") {
    echo       "<a style = 'right: 0;' href = 'ManageEventForm.php?eventid=" . $event->eventId . "' class='button'>Manage</a>";
}
echo"       </div>
            <div class='media-contain'>
                <a href='#'><div class='media-box'><img src=\"images/facebook.png\"></div></a>
                <a href='#'><div class='media-box'><img src=\"images/twitter.png\"></div></a>
                <a href='#'><div class='media-box'><img src=\"images/youtube.png\"></div></a>
            </div>         
        </div>
        ";

}
echo "  </div>";?>

<script>
    $(document).ready(function(){
        $(".dropdown").change(function(){
            $("#orderEventsForm").submit();
        });
    });
</script>
<?php

echo makePageFooter();
?>
