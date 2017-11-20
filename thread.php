<?php
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$threadId = htmlspecialchars($_GET["threadId"]);

$dbConn = databaseConn::getConnection();
$threadSQL = "select *
             from bp_thread 
             left join bp_user 
             on bp_thread.userId=bp_user.userId
             WHERE bp_thread.userId='$threadId'
             order by datePosted";

$stmt = $dbConn->query($threadSQL);
// output data of each row
while ( $thread = $stmt->fetchObject()) {

    echo "<h1>$thread->threadTitle</h1>
<p>some text</p>";
}

echo makePageFooter();
