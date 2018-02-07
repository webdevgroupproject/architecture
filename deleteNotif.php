<?php

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();


$userId = $_SESSION['userId'];
$notifID = filter_has_var(INPUT_GET, 'deleteNotification') ? $_GET['deleteNotification'] : null;

    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $notifDLT = "DELETE FROM `bp_notification`
        WHERE `bp_notification`.`notificationID` = $notifID";
        // use exec() because no results are returned
        $dbConn->exec($notifDLT);
        header("Location: notifications.php");
    }
    catch(PDOException $e) {
        echo $notifDLT . "<br>" . $e->getMessage();
    }
