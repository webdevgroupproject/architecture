<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


$userId = $_SESSION['userId'];
$secUserID = filter_has_var(INPUT_GET, 'threadTitle') ? $_GET['threadTitle'] : null;
$threadInfo = filter_has_var(INPUT_GET, 'threadInfo') ? $_GET['threadInfo'] : null;
$threadTitle = filter_var($threadTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
if (empty($threadTitle)) {
    $error = "<p>please enter a name</p>";
    echo $error;
} else {

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addConvoSql = "    INSERT INTO bp_conversation (startUserID, secUserID, time)
                        VALUES ('$userId', '$secUserID', now())";
        // use exec() because no results are returned
        $dbConn->exec($addConvoSql);
        header("Location: messaging.php");
    }
    catch(PDOException $e) {
        echo $addConvoSql . "<br>" . $e->getMessage();
    }

}
