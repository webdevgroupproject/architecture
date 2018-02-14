<?php
//Ross Brown
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
//get the thread and the reported message
$messageId = filter_has_var(INPUT_GET, 'messageId') ? $_GET['messageId'] : null;
$threadId = filter_has_var(INPUT_GET, 'threadId') ? $_GET['threadId'] : null;

//connect to the database and add 1 to the reported column in bp_thread_message
try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $updateSql = "UPDATE bp_thread_message
                  SET reported= '1'
                  WHERE threadMessId = '$messageId'";
    // use exec() because no results are returned
    $dbConn->exec($updateSql);
    //return user to the thread message page
    header("Location: thread.php?threadId=$threadId");

}
catch(PDOException $e) {
    echo $updateSql . "<br>" . $e->getMessage();
}