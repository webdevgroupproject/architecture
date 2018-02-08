<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


$userId = $_SESSION['userId'];
$secUserID = filter_has_var(INPUT_GET, 'newConversation') ? $_GET['newConversation'] : null;
if (empty($secUserID)) {
    echo "<p>please enter a name</p>";
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
