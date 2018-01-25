<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = filter_has_var(INPUT_GET, 'eventid') ? $_GET['eventid'] : null;
$address1 = filter_has_var(INPUT_GET, 'address1') ? $_GET['address1'] : null;
$address2 = filter_has_var(INPUT_GET, 'address2') ? $_GET['address2'] : null;
$city = filter_has_var(INPUT_GET, 'city') ? $_GET['city'] : null;
$postcode = filter_has_var(INPUT_GET, 'postcode') ? $_GET['postcode'] : null;
$date = filter_has_var(INPUT_GET, 'date') ? $_GET['date'] : null;
$time = filter_has_var(INPUT_GET, 'time') ? $_GET['time'] : null;
$name = filter_has_var(INPUT_GET, 'name') ? $_GET['name'] : null;
$spaces = filter_has_var(INPUT_GET, 'spaces') ? $_GET['spaces'] : null;
$info = filter_has_var(INPUT_GET, 'info') ? $_GET['info'] : null;
$image = filter_has_var(INPUT_GET, 'image') ? $_GET['image'] : null;

if (empty($image)) {
    $image = "defaultEventImg.jpeg";
}


echo "<p>event number $eventId</p>";
echo "<p>$address1</p>";
echo "<p>$address2</p>";
echo "<p>$city</p>";
echo "<p>$postcode</p>";
echo "<p>$date</p>";
echo "<p>$time</p>";
echo "<p>$name</p>";
echo "<p>$spaces</p>";
echo "<p>$info</p>";
try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $updateSql = "UPDATE bp_events
                  SET eventName = '$name',
                      eventDate= '$date',
                      eventTime= '$time',
                      eventPlace= '$address1',
                      eventAddress2= '$address2',
                      eventCity= '$city',
                      eventPostcode= '$postcode',
                      eventSpaces= '$spaces',
                      eventImage= '$image',
                      eventInfo= '$info'
                  WHERE eventId = '$eventId'";
    // use exec() because no results are returned
    $dbConn->exec($updateSql);
    header("Location: eventPage.php?eventid=".$eventId);

}
catch(PDOException $e) {
    echo $updateSql . "<br>" . $e->getMessage();
}