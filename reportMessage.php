<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$messageId = filter_has_var(INPUT_GET, 'messageID') ? $_GET['messageID'] : null;
$convoId = filter_has_var(INPUT_GET, 'convoID') ? $_GET['convoID'] : null;

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $updateSql = "UPDATE bp_message
                  SET reported= '1'
                  WHERE messageID = '$messageId'";
    // use exec() because no results are returned
    $dbConn->exec($updateSql);
    header("Location: messaging.php?activeID=$convoId");

}
catch(PDOException $e) {
    echo $updateSql . "<br>" . $e->getMessage();
}
