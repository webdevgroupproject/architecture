<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


$userId = $_SESSION['userId'];
$threadTitle = filter_has_var(INPUT_GET, 'threadTitle') ? $_GET['threadTitle'] : null;
$threadInfo = filter_has_var(INPUT_GET, 'threadInfo') ? $_GET['threadInfo'] : null;
$threadTitle = filter_var($threadTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$threadInfo = filter_var($threadInfo, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$errors = array();
if (empty($threadTitle)) {
    $errors[] = "<p>please enter a message title</p>";
}

if (empty($threadInfo)) {
    $errors[] = "<p>please enter message info</p>";

}
if (!empty($errors)) {
    foreach ($errors as $currentError) {
        echo $currentError;
    }
}else {

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $addThreadSql = "    INSERT INTO bp_thread (userId, threadTitle, threadInfo, timePosted, datePosted)
                        VALUES ('$userId', '$threadTitle', '$threadInfo', now(), now())";
        // use exec() because no results are returned
        $dbConn->exec($addThreadSql);
        header("Location: forum.php");
    }
    catch(PDOException $e) {
        echo $addThreadSql . "<br>" . $e->getMessage();
    }

}
