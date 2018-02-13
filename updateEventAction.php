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

$address1 = filter_var($address1, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$address2 = filter_var($address2, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$city = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$postcode = filter_var($postcode, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$info = filter_var($info, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


$errors = array();


if (empty($address1)) {
    $errors[] = "<p>please enter the first line of the address</p>";
}
if (empty($city)) {
    $errors[] = "<p>please enter the first line of the address</p>";
}
if (empty($postcode)) {
    $errors[] = "<p>Please enter a postcode</p>";
}else{
    if (preg_match("/^[a-zA-Z]{1,2}([0-9]{1,2}|[0-9][a-zA-Z])\s*[0-9][a-zA-Z]{2}$/", "$postcode")) {

    }else{
        $errors[] = "enter a valid postcode";
    }
}
if (empty($date)) {
    $errors[] = "<p>Please enter a date</p>";
}
if (empty($time)) {
    $errors[] = "<p>Please enter a time</p>";
}
if (empty($name)) {
    $errors[] = "<p>Please enter an event name</p>";
}
if (empty($spaces)) {
    $errors[] = "<p>Please choose how many spaces are available</p>";
}
if (empty($image)) {
    $image = "defaultEventImg.jpeg";
}
if (!empty($errors)) {
    echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
    echo makeHeader();
    foreach ($errors as $currentError) {
        echo $currentError;
    }
    echo makePageFooter();
}
else{
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
        $eventSQL ="SELECT *
               FROM bp_events
               WHERE eventId = '$eventId'";
        $eventQuery = $dbConn->query($eventSQL);
        while($eventInfo = $eventQuery->fetchObject()){

            $to = "ross.al.brown92@gmail.com";
            $subject = "Blueprint ticket info";

            $message = "
<html>
<head>
<title>Event Uptated</title>
</head>
<body>
<h1>".$eventInfo->eventName." has been updated</h1>
<p>Check your events for details.</p>
</body>
</html>
";

// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
            $headers .= 'From: <blueprint@donotreply.com>';

            mail($to,$subject,$message,$headers);

        }
        header("Location: eventPage.php?eventid=".$eventId);

    }
    catch(PDOException $e) {
        echo $updateSql . "<br>" . $e->getMessage();
    }
}
