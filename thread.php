<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$threadId = htmlspecialchars($_GET["threadId"]);
$userType = checkUserType();
$pro = checkProStatus();
$dbConn = databaseConn::getConnection();
$threadInfoSQL = "SELECT *
                  FROM bp_thread
                  WHERE threadId = '$threadId' ";
$threadMessSQL = "select *
             from bp_thread_message 
             INNER JOIN bp_user
             ON bp_thread_message.userId=bp_user.userId
             WHERE bp_thread_message.threadID = '$threadId'
             order by bp_thread_message.datePosted ASC, bp_thread_message.timePosted ASC";

$threadInfo = $dbConn->prepare($threadInfoSQL);
$threadInfo->execute();

$resultSet = $dbConn->prepare($threadMessSQL);
$resultSet->execute();
$resultCount = $resultSet->rowCount();
while ($thread = $threadInfo->fetch(PDO::FETCH_ASSOC)) {
    echo"
        <h1>".$thread['threadTitle']."</h1>
        <div class='filterBar'>
            <div class='thread-info-contain'>
                <p>\"".$thread['threadInfo']."\"</p>
            </div>";
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){
        echo"
            <div class=\"postThread\" id='postThread' style='display: none'>
                <div class=\"form-container\" style='width: 33%;'>
                    <form method=\"get\" action=\"addThreadMessage.php\" id='postThreadForm'>
                        <label for='postReply' style='display: none;'>Reply</label><br/>
                        <textarea placeholder=\"Post your reply here\" style=\"max-width: 100%; width: 100%; margin-bottom: 10px;\" name=\"replyMess\" id='postReply' class=\"form-control block\" data-validation=\"required\"></textarea>
                        <label for='anonymous'>Post anonymously</label>
                        <input type='text' name='threadId' style='display: none' value='".$thread['threadId']."'>
                        <input type='checkbox' name='anonymous' id='anonymous'><br>
                        <input type=\"submit\" value=\"Post\" class=\"button\">
                        <a class='button' onclick='toggleForm()' id='closeFormButton'>Hide</a>
                    </form>
                </div>  
            </div>
            <a class='button' onclick='toggleForm()' id='openFormButton' style='padding: 1em; margin: 0; float: left;'>Reply</a>";
    }
    else{
        echo "
            <p><a href='login.php'>log in</a> to send a reply</p>";
    }

    echo"
            <div class='clear'></div>
          </div>";
    if ($pro == "1" || $userType == "admin"){
        echo "";
    }else{
        echo"
          <div class='payToHideBanner'>
            <a href='#'><img src=\"images/advert.png\"></a>
          </div>";
    }

    if ($resultCount < 1){
    echo"
          <div class='reply-result-set'>
            <div class='forum-message'>
                <div class='thread-info'>
                    <p>No replys yet</p>
                </div>
                <div class='clear'></div>
            </div>    
          </div>";
    }
    else{
        echo"
          <div class='reply-result-set'>";
        while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
            $date = $row['datePosted'];
            $dateString = strtotime($date);
            $formatDate = date("m/d/Y", $dateString);
            $time = $row['timePosted'];
            $timeString = strtotime($time);
            $formatTime = date("h:ia", $timeString);
            echo"
          
            <div class='forum-message'>
                <div class='profileImgContain'>";
            if ($row['anonymous'] == "1"){
                echo"
                    <img src=\"images/default_user.png\">
                </div>
                <div class='message-info'>
                    <span>anonymous posted at ".$formatTime." on ".$formatDate."</span>";

            }else{
                echo "<img src=\"images/profilepicture.jpg\">
                </div>
                <div class='message-info'>
                    <span><a href='#'>".$row['username']."</a> posted at ".$formatTime." on ".$formatDate."</span>";

            }
            echo"
                    
                    <p>".$row['message']."</p>
                </div>
                <div class='reportContain'>";
                if ($row['reported'] == "0"){
                    echo "
                    <a href='reportThreadMessage.php?messageId=".$row['threadMessId']."&threadId=".$threadId."'>Report this message</a>";
                }else{
                    echo"
                    <p style='color: #b50021;'>This message has been reported</p>";
                }
                echo"
                
                    
                </div>
                <div class='clear'></div>
            </div>    
          ";
        }
        echo"</div>";
    }
}
?>
    <script>
        function toggleForm() {
            var toggleElement = document.getElementById("postThread");
            var openFormButton = document.getElementById("openFormButton");
            if (toggleElement.style.display === "none") {
                toggleElement.style.display = "block";
                openFormButton.style.display = "none";
            } else {
                toggleElement.style.display = "none";
                openFormButton.style.display = "inline-block";
            }
        }
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            form : "#postReply"

        });
    </script>
<?php
echo makePageFooter();
?>