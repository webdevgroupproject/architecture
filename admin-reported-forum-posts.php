<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin reported forum posts");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbConn = databaseConn::getConnection();
?>
<style>
    .search-box {
        position: relative;
        display: inline-block;
        font-size: 14px;
        float: left;
        width: 400px;
    }

    .anonymous {
        height: auto;
        width: auto;
        margin: 5%;
    }

    .imageHalfContain {
        width: 45%;
        margin-left: 5%;
    }

    #customers {
        width: 85%;
        margin-left: 100px;
    }

    .refine-box {
        float: right;
        width: 400px;
        display: inline-block;
        position: relative;

    }

</style>
<?php

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1>Reported forum posts</h1><br/> ";


    echo "<div class='images-container' style='width: 90%; margin-left:5%;'>";

        $userNameSearch = isset($_REQUEST["userNameSearch"]) ? $_REQUEST["userNameSearch"] : null;

        $query = "SELECT bp_user.userId, threadMessId, bp_thread.threadId, username, message FROM bp_thread_message inner join bp_user on bp_thread_message.userId = bp_user.userId  join bp_thread on bp_thread.threadId = bp_thread_message.threadID where 1 and reported = 1 ";
        $sqlCondition = ' ';
        if (!empty($userNameSearch)) {
            $sqlCondition .= " and username LIKE '%$userNameSearch%'";
        }
        $sqlSearch = $query . $sqlCondition;
        $result = $dbConn->prepare($sqlSearch);
        $result->execute();
        $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);
        $numRows = $result->rowCount();
        if ($numRows > 0) {
            echo "<div class='filterBar'>

        <form action='admin-reported-forum-posts.php' method='post'>
            <div class='search-box'>
                <input type=\"text\" name='userNameSearch' style='width: 300px;' autocomplete=\"off\" placeholder=\"Search users...\" />
                <button type='submit' name='searchUser'><i class=\"material-icons\">search</i></button>
            </div>
            </form>
            
            <div class='clear'></div>
        </div>";
            echo "<table id=\"customers\">

        
          <tr>
            <th>Reported user</th>
            <th style=\"width:700px; max - width: 700px;\">Forum message posted</th>
            <th style=\"width:100px; max - width: 100px;\">View</th>
            <th style=\"width:100px; max - width: 100px;\">Delete message</th>
            <th style=\"width:100px; max - width: 100px;\">Delete and Suspend</th>
            <th style=\"width:100px; max - width: 100px;\">Ignore</th>
          </tr>";
            foreach ($recordSet as $row) {
                $messageID = $row['threadMessId'];
                $userID = $row['userId'];
                $threadID = $row['threadId'];
                echo "<tr>
                <td>$row[username]</td>
                <td>$row[message]</td>
                <td><a class='button' style='margin: 0;' href='thread.php?threadId=$threadID'>View message</a></td>
                <td><a class='button' style='margin: 0;'  href='delete-forum-post.php?threadMessId=$messageID' >Delete message</a></td>
                <td><a class='button' style='margin: 0;'  href='suspend-reported-forum-reason.php?userId=$userID&threadMessId=$messageID' >Suspend and delete</a></td>
                <td><a class='button' style='margin: 0;'  href='ignore-forum-post.php?threadMessId=$messageID' >Ignore report</a></td>
              </tr>";
            }
        } else {
            echo "<p style='text-align: center'>There are no new reported forum posts to address to. </p>";
        }
    echo " </table>
    </div>";

} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>


