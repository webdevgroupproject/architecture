<?php
require_once ('scripts/functions.php');
echo startSession();
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

while ($indvEvent = $stmt->fetchObject()) {
    $date = $indvEvent->eventDate;
    $dateString = strtotime($date);
    $formatDate = date("l, jS F Y", $dateString);
    $time = "$indvEvent->eventTime";
    $timeString = strtotime($time);
    $formatTime = date("h:ia", $timeString);
    $address1 = $indvEvent->eventPlace;
    $address2 = $indvEvent->eventAddress2;
    $city = $indvEvent->eventCity;
    $postcode = $indvEvent->eventPostcode;
    $noSignedUpSQL = "select * 
                      from bp_event_signup
                      WHERE eventId = '$eventId'";
    $noSignedUpstmt = $dbConn->prepare($noSignedUpSQL);
    try {
        $noSignedUpstmt->execute();
        $noAttending = $noSignedUpstmt->rowCount();
        $noSpaces = $indvEvent->eventSpaces;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    $spacesLeft = $noSpaces - $noAttending;

    echo "
            <div class=\"home-banner\" id='eventPageBanner'>
                <div class='EventTitle'>
                    <h1>" . $indvEvent->eventName . "</h1>
                    <p class='tagline'>$formatDate at $formatTime</p>
                    <p class='tagline'>$city</p>
                </div>
                <img src=\"images/event-img-1.jpeg\" alt=\"image of a blue print\">
            </div>    
            <div class='eventInfo'>
                <div class='infoBox'>
                    <h2>Ticket information</h2>
                    <p id='eventInfoText'>$indvEvent->eventInfo</p>";


                    if (isset($_SESSION['username'])) {
                        $userId = $_SESSION['userId'];
                        $checkSignedUpSQL = "select *
                                             from bp_event_signup
                                             WHERE eventId = '$eventId'
                                             AND userId = '$userId'";
                        $checkSignedUpRes = $dbConn->query($checkSignedUpSQL);
                        if ($checkSignedUpRes) {
                            /* Check the number of rows that match the SELECT statement */
                            if ($checkSignedUpRes->fetchColumn() > 0) {
                                if ($noAttending <= 1){
                                    echo "<p>No one else has signed up for this event yet</p>";
                                }
                                elseif ($noAttending == 2){
                                    echo "<p>One other person is registered for this event</p>";
                                }
                                else{
                                    echo "<p>".($noAttending -1)." people are registered for this event</p>";
                                }
                                echo "<a href='dropOutAction.php?eventid=" . $indvEvent->eventId . "' class='button'>Drop out</a> ";
                            }
                            /* No rows matched -- do something else */
                            else {
                                echo "<p>$spacesLeft<span> spaces left</span></p>";
                                echo "<a href='registerAction.php?eventid=" . $indvEvent->eventId . "' class='button'>Register</a> ";
                            }

                        }

                    }
                    else{
                        echo "<div style='font-size: 1.2em;'><a href='login.php'>Log in</a><span> to register</span></div>";
                        $noAttending = $noSignedUpstmt->rowCount();
                        echo $noAttending;
                    };

    echo"       </div>
                <div class='infoBox'>
                    <h2>When &amp; where</h2>
                <div id=\"googleMap\"></div>
                <div>
                    <input id=\"address\" type=\"textbox\" value=\"".$indvEvent->eventPostcode."\"onload=\"codeAddress()\" style='display: none;'>
                </div>
                <div class='dateAddressBox'>
                    <p style='font-weight: bold; font-size: 1.09em;'>$address1</p>
                    <p>$address2</p>
                    <p>$city</p>
                    <p>$postcode</p>
                </div>
                <div class='dateAddressBox'>
                    <p>$formatDate at $formatTime</p>
                </div>
            </div>    
            ";

                       
echo"<script>
    function myMap() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(54.978252,-1.617780);
        var mapOptions = {
            zoom: 5,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById(\"googleMap\"), mapOptions);
    }    
    function codeAddress() {
        var address = document.getElementById('address').value;
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,            
                    position: results[0].geometry.location,
                });
                map.setZoom(12);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
              }
        });
    }
    window.onload = codeAddress;
</script>
<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyBzchtixjwkdocwfYPZYd26c-bYbAXvI3c&callback=myMap\"></script>";
}
echo makePageFooter();
