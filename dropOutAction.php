<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');

$eventId = htmlspecialchars($_GET["eventid"]);
$userId = $_SESSION['userId'];

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $regSql ="DELETE FROM bp_event_signup
              WHERE eventId = '$eventId'
              AND userId = '$userId'";
    // use exec() because no results are returned
    $dbConn->exec($regSql);
    header("Location: eventPage.php?eventid=".$eventId);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
