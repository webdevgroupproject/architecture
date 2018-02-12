<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$threadId = htmlspecialchars($_GET["threadId"]);

try {
    $dbConn = databaseConn::getConnection();
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $deleteSql = "DELETE FROM bp_thread WHERE threadId='$threadId'";
    // use exec() because no results are returned
    $dbConn->exec($deleteSql);
    header('Location: forum.php');

}
catch(PDOException $e) {
    echo $deleteSql . "<br>" . $e->getMessage();
}
