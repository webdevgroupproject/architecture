<?php
require_once ('scripts/functions.php');

require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$dbConn = databaseConn::getConnection();

$sqlCount = "SELECT count(*) FROM bp_thread_message";
$result = $dbConn->prepare($sqlCount);
$result->execute();
$number_of_rows = $result->fetchColumn();

$forumSQL = 'select *
             from bp_thread 
             left join bp_user 
             on bp_thread.userId=bp_user.userId
             order by datePosted';

$stmt = $dbConn->query($forumSQL);

echo "<div class=\"threads-wrapper\">
<h1>Discussion board</h1>";
while ( $forum = $stmt->fetchObject()) {


    echo "

<div class=\"thread\">
            <img src=\"Images/default_user.png\">
            <a href=\"thread.php?threadId=$forum->threadId\">
            <div class=\"thread-info\">
                <h2>$forum->threadTitle</h2>
                <span>$forum->username | Posted: $forum->datePosted | <strong>$number_of_rows responses</strong></span>
                <p>$forum->threadInfo</p>
            </div>
        </a>
        </div>
          </div>";
}
echo " </div>";
?>


<?php
echo makePageFooter();
?>