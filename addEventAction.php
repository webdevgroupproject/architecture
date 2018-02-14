<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

$userId = $_SESSION['userId'];

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
    echo "<h1>Add an event</h1>
    <div class=\"form-container\">";
    foreach ($errors as $currentError) {
        echo $currentError;
    }
    echo"
        <form method=\"get\" action=\"addEventAction.php\">
            <fieldset>
                <legend>Where</legend>
                <label>Address line 1: </label>
                <input type=\"text\" name=\"address1\">
                <label>Address line 2 (optional): </label>
                <input type=\"text\" name=\"address2\">
                <label>City: </label>
                <input type=\"text\" name=\"city\">
                <label>Postcode: </label><br>
                <input style=\"width: 150px;\" type=\"text\" name=\"postcode\"><br>
            </fieldset>
            <fieldset>
                <legend>When</legend>
                <label>Date: </label><br>
                <input style=\"width: 150px;\" type=\"date\" name=\"date\"><br>
                <label>Time: </label><br>
                <input style=\"width: 150px;\" type=\"time\" name=\"time\"><br>
            </fieldset>
            <fieldset>
                <legend>Additional info</legend>
                <label>Event name: </label>
                <input type=\"text\" name=\"name\">
                <label>Spaces: </label><br>
                <input style=\"width: 150px;\" type=\"number\" name=\"spaces\"><br>
                <label>Event Information: </label>
                <textarea style=\"max-width: 100%; width: 100%; margin-bottom: 1em;\" name=\"info\" id='info'></textarea>
                <label>Image: </label>
                <input type=\"file\" name=\"image\">
            </fieldset>
            <div class=\"submit-wrap\">
            <input type=\"submit\" value=\"Add event\" class=\"button\">
            </div>
        </form>
    </div>";
    echo makePageFooter();
} else {

    $address1 = filter_var($address1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $address2 = filter_var($address2, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $city = filter_var($city, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $info = filter_var($info, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addEventSql = "    INSERT INTO bp_events (eventName, eventCreator, eventDate, eventTime, eventPlace, eventAddress2, eventCity, eventPostcode, eventSpaces, eventImage, eventInfo)
                        VALUES ('$name', '$userId', '$date', '$time', '$address1', '$address2', '$city', '$postcode', '$spaces', '$image', '$info' )";
        // use exec() because no results are returned
        $dbConn->exec($addEventSql);
        header("location: events.php");
    }
    catch(PDOException $e) {
        echo $addEventSql . "<br>" . $e->getMessage();
    }

}
