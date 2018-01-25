<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$userType = checkUserType();
echo "
<h1>Upcoming events</h1>
<div class='filterBar'>
    <form id='orderEventsForm' action='#' onchange=\"sortBy(this.value)\">
		    <label>Order by: </label>
			<select class='dropdown' name=\"searchBy\">
			    <option value=\"date\" selected>Date</option>
				<option value=\"location\">Location</option>
				<option value=\"attending\">people attending</option>
			</select>
    </form>";
    if ($userType == "admin"){
        echo "<a href='addEventForm.php' class='button' id='addEventButton'>Add an event</a>";
    };
echo"

</div>
<div class=\"images-container\">


";

$dbConn = databaseConn::getConnection();

$eventSQL = 'select *
             from bp_events
             order by eventDate';

$stmt = $dbConn->query($eventSQL);
    // output data of each row
    while ( $event = $stmt->fetchObject()) {
      $eventImage = $event->eventImage;
      $defaultImage = "defaultEventImg.jpeg";
      echo "<div class=\"imageThirdContain\">
            <a href=\"eventPage.php?eventid=" . $event->eventId . "\">
            <div class=\"image-with-text\">
              <img src=\"images/";
            echo $eventImage;
              echo"\" alt=\"Event image\">
              </a>
              <div class=\"attendance-info-banner\">
                <span class=\"number-attending\">9 attending $eventImage</span>
                <span class=\"spaces-left\">11 spaces left</span>
              </div>
              <div class=\"image-text\"><p class='imageTextTitle'>" . $event->eventName . "</p>";
                                         if ($userType == "admin") {
                                             echo "<a href = 'ManageEventForm.php?eventid=" . $event->eventId . "' class='button'>Manage</a>";
                                             }
                                         echo"<p>" . $event->eventDate . " | " . $event->eventPlace . " | " . $event->eventTime . "</p>
              </div>
            </div>
            
          </div>";

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
