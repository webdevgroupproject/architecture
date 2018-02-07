<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$threadId = htmlspecialchars($_GET["threadId"]);

$dbConn = databaseConn::getConnection();
$threadSQL = "select *
             from bp_thread 
             WHERE threadID='$threadId'
             order by datePosted";

$stmt = $dbConn->query($threadSQL);
// output data of each row
while ( $thread = $stmt->fetchObject()) {

    echo "<h1>$thread->threadTitle</h1>
          <p class='tagline'>$thread->threadInfo</p>";
}

echo makePageFooter();
