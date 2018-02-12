<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$eventId = htmlspecialchars($_GET["eventid"]);

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $deleteSql = "DELETE FROM bp_events WHERE eventId='$eventId'";
    // use exec() because no results are returned
    $dbConn->exec($deleteSql);
    header('Location: events.php');

}
catch(PDOException $e) {
    echo $deleteSql . "<br>" . $e->getMessage();
}
