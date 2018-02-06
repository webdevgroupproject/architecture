<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

$userId = $_SESSION['userId'];
$anonymous = filter_has_var(INPUT_GET, 'anonymous') ? $_GET['anonymous'] : null;
$replyMess = filter_has_var(INPUT_GET, 'replyMess') ? $_GET['replyMess'] : null;
$threadId = filter_has_var(INPUT_GET, 'threadId') ? $_GET['threadId'] : null;
$reply = filter_var($replyMess, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$errors = array();
if (empty($reply)) {
    $errors[] = "<p>please enter a message title</p>";
}
if (!empty($errors)) {
    foreach ($errors as $currentError) {
        echo $currentError;
    }
}else {
    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($anonymous == "on"){

        $addThreadSql = "    INSERT INTO bp_thread_message (threadID, userId, message, datePosted, timePosted, anonymous, reported)
                             VALUES ('$threadId', '$userId', '$reply', now(), now(), '1', '0')";
    }else{
        $addThreadSql = "    INSERT INTO bp_thread_message (threadID, userId, message, datePosted, timePosted, anonymous, reported)
                             VALUES ('$threadId', '$userId', '$reply', now(), now(), '0', '0')";
    }
                // use exec() because no results are returned
       $dbConn->exec($addThreadSql);
        header("Location: thread.php?threadId=$threadId");
    }
    catch(PDOException $e) {
        echo $addThreadSql . "<br>" . $e->getMessage();
    }
}
