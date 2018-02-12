<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Messages");
echo makeHeader();

$convoID = $_GET["conversationID"];

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $deleteSql = "DELETE FROM bp_conversation WHERE conversationID = '$convoID'";
    // use exec() because no results are returned
    $dbConn->exec($deleteSql);
    header('Location: messaging.php');

}
catch(PDOException $e) {
    echo $deleteSql . "<br>" . $e->getMessage();
}
