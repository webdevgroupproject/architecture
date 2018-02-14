<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Messages");
echo makeHeader();

$messageID = filter_has_var(INPUT_GET, 'messageID') ? $_GET['messageID'] : null;
$activeID = filter_has_var(INPUT_GET, 'activeID') ? $_GET['activeID'] : null;

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $deleteSql = "DELETE FROM bp_message WHERE messageID = '$messageID'";
    // use exec() because no results are returned
    $dbConn->exec($deleteSql);
    header("Location: messaging.php?activeID=" .urlencode(serialize($activeID)));

}
catch(PDOException $e) {
    echo $deleteSql . "<br>" . $e->getMessage();
}
