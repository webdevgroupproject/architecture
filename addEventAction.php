<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


//Request username and password from the request stream
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

$errors = array();

if (empty($address1)) {
    $errors[] = "<p>please enter the first line of the address</p>";
}

if (empty($city)) {
    $errors[] = "<p>please enter the first line of the address</p>";
}

if (empty($postcode)) {
    $errors[] = "<p>Please enter a postcode</p>";
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

if (!empty($errors)) {
    foreach ($errors as $currentError) {
        echo $currentError;
    }
} else {



    $address1 = filter_var($address1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $address2 = filter_var($address2, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $city = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $info = filter_var($info, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addEventSql = "    INSERT INTO bp_events (eventName, eventDate, eventTime, eventPlace, eventAddress2, eventCity, eventPostcode, eventSpaces, eventImage, eventInfo)
                        VALUES ('$name', '$date', '$time', '$address1', '$address2', '$city', '$postcode', '$spaces', '$image', '$info' )";
        // use exec() because no results are returned
        $dbConn->exec($addEventSql);
        echo "<p>$name Added successfully</p>" .
                "<a href='events.php'>Back to events</a>";
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

}
