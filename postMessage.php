<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

//Request username and password from the request stream
$message = filter_has_var(INPUT_GET, 'message-text') ? $_GET['message-text'] : null;
$convoID = filter_has_var(INPUT_GET, 'messConvoID') ? $_GET['messConvoID'] : null;
$userId = $_SESSION['userId'];

if (empty($message)) {
    echo "<p>please enter a message</p>";
} else {

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $messageSQL = "INSERT INTO bp_message (UserID, conversationID, message, date, time)
                      VALUES ('$userId', '$convoID', '$message', now(), now());
                      UPDATE bp_conversation AS c
                      INNER JOIN bp_message as m
                      ON m.conversationID = c.conversationID
                      SET c.lastMessage = '$message', c.time = now()
                      WHERE c.conversationID = $convoID";

        // use exec() because no results are returned
        $dbConn->exec($messageSQL);
        header("location: messaging.php?activeID=$convoID");
    }
    catch(PDOException $e) {
        echo $messageSQL . "<br>" . $e->getMessage();
    }

}
