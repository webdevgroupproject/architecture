<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$eventId = htmlspecialchars($_GET["eventid"]);
$userType = checkUserType();
$dbConn = databaseConn::getConnection();
$indvEventSQL = "select *
                 from bp_events
                 WHERE eventId = '$eventId'
                 order by eventDate";
$stmt = $dbConn->query($indvEventSQL);
// output data of each row

while ($indvEvent = $stmt->fetchObject()) {
    $name = $indvEvent->eventName;
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
    $image = $indvEvent->eventImage;
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
        <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <a href='#' class=\"close\" style='text-decoration: none;'>&times;</a>
                    <h1>Confirm your place at $name</h1>
                </div>
                <div class=\"modal-body\">
                    <p style='font-size: 1.5em;margin-top: 10px;'>Once you have confirmed your place at \"$name\" we will send you an email with your ticket information. Please hold on to this information as you will need it for entry into the event. </p>
                    <div class='dateAddressBox' style='margin: 10px 0'>
                        <p style='font-weight: bold; font-size: 1.09em;'>$name</p>
                        <p>$address1</p>
                        <p>$address2</p>
                        <p>$city</p>
                        <p>$postcode</p>
                    </div>
                    <div class='dateAddressBox' style='margin: 10px 0;'>
                        <p>$formatDate at $formatTime</p>
                    </div>
                </div>
                <div class='modal-footer'>
                    <a href='registerAction.php?eventid=$eventId' class='button'>Confirm</a>
                    <a href='#' style='margin-left:10px;' class='cancel'>Cancel</a>
                </div>
            </div>
        </div>
        <div id=\"myModal2\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <span class=\"close\">&times;</span>
                    <h1>Are you sure you want to drop out of $name?</h1>
                </div>
                <div class=\"modal-body\">
                    <p style='font-size: 1.5em;margin-top: 10px;'>If you drop out of $name your ticket will no longer be valid, you wont be able to gain entry to this event with your current ticket information. We will send you an email to confirm. </p>
                </div>
                <div class='modal-footer'>
                    <a href='dropOutAction.php?eventid=" . $indvEvent->eventId . "' class='button'>Drop out</a>
                    <a href='#' style='margin-left:10px;' class='cancel'>Cancel</a>
                </div>
            </div>
        </div>
            <div class=\"home-banner\" id='eventPageBanner'>
                <div class='EventTitle'>
                    <h1>$name</h1>
                    <p class='tagline'>$formatDate at $formatTime</p>
                    <p class='tagline'>$city</p>
                </div>
                <img src=\"images/$image\" alt=\"image of a blue print\">
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
                                echo "<div style='margin-bottom: 25px;'><p class='registeredText'>You are registered to attend this event</p>
                                       <span>(check your email for ticket information) </span><a href='#myModal2'>Drop out</a></div>";

                                if ($noAttending <= 1){
                                    echo "<p>No one else has signed up for this event yet</p>";
                                }
                                elseif ($noAttending == 2){
                                    echo "<p>One other person is registered for this event</p>";
                                }
                                else{
                                    echo "<p>".($noAttending -1)." people are registered for this event</p>";
                                }
                                if ($userType == "admin") {
                                    echo "<a href = 'ManageEventForm.php?eventid=" . $eventId . "' class='button'>Manage</a>";
                                }

                            }
                            /* No rows matched -- do something else */
                            else {

                                echo "<a href='#myModal' class='button' id=\"modalButton\">Register</a> ";
                                if ($userType == "admin") {
                                    echo "<a href = 'ManageEventForm.php?eventid=" . $eventId . "' class='button'>Manage</a>";
                                }
                                echo "<p style='margin-top: 5px;'>$spacesLeft<span> spaces left</span></p>";
                            }

                        }

                    }
                    else{
                        echo "<div style='font-size: 1.2em;'><a href='login.php'>Log in</a><span> to register</span></div>";
                    };


    echo"       
                
            </div>
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
//<script> //Get the modal
//var modal = document.getElementById('myModal');
//
//// Get the button that opens the modal
//var btn = document.getElementById(\"modalButton\");
//
//// Get the <span> element that closes the modal
//var close = document.getElementsByClassName(\"close\")[0];
//var cancel = document.getElementsByClassName(\"cancel\")[0];
//
//// When the user clicks the button, open the modal
//btn.onclick = function() {
//    modal.style.display = \"block\";
//}
//
//// When the user clicks on <span> (x), close the modal
//close.onclick = function() {
//    modal.style.display = \"none\";
//}
//cancel.onclick = function() {
//    modal.style.display = \"none\";
//}
//
//// When the user clicks anywhere outside of the modal, close it
//window.onclick = function(event) {
//    if (event.target == modal) {
//        modal.style.display = \"none\";
//    }
//}
</script>
<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyBzchtixjwkdocwfYPZYd26c-bYbAXvI3c&callback=myMap\"></script>";
}
echo makePageFooter();
