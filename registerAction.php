<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);
$userId = $_SESSION['userId'];

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $regSql ="INSERT INTO bp_event_signup (eventId, userId)
               VALUES ($eventId, $userId)";
    // use exec() because no results are returned
    $dbConn->exec($regSql);
    header('Location: events.php');
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

echo makePageFooter();