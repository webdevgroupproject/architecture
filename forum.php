<?php
require_once ('scripts/functions.php');
echo startSession();
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

echo "<h1>Discussion board</h1><div class=\"threads-wrapper\">";
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
          ";
}
echo "</div>";
if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){
    echo "<div class=\"postThread\">
<h2>Start a thread</h2>
            <div class=\"form-container\">
        <form method=\"get\" action=\"#\" id='postThreadForm'>
            <label for='title'>Thread title: </label>
            <input type=\"text\" name=\"title\" id='title'>
            <label for='postThread'>Thread information (optional): </label><br/>
            <textarea style=\"max-width: 100%; width: 100%;\" name=\"username\" id='postThread'></textarea>
            <div class=\"submit-wrap\">
                <input type=\"submit\" value=\"Post\" class=\"button\">
            </div>
        </form>
    </div>  
          </div>";
}
else{
    echo "sign in to post a thread";
};
?>


<?php
echo makePageFooter();
?>