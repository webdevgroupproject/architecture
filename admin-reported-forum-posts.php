<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin reported messages and posts");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbConn = databaseConn::getConnection();
?>
<style>
    form.search-box{
        position: relative;
        display: inline-block;
        font-size: 14px;
        float: left;
        width: 340px;
    }

    .refine-box{
        float: right;

    }

    .refine-box span {
        padding-left:50px;
        display: inline-block;

    }

    .refine-box input {

        display: inline-block;
    }

    .imageHalfContain {
        width:45%;
        margin-left:5%;
    }

    #customers {
        width: 85%;
        margin-left:100px;
    }

</style>
<?php

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1>Reported forum posts</h1><br/> ";


    echo "<div class='images-container' style='width: 90%; margin-left:5%;'>";
        if (isset($_POST['searchUser'])) {
            $searchQuery = isset($_REQUEST["searchQuery"]) ? $_REQUEST["searchQuery"] : null;
            $query = "SELECT bp_user.userId, threadMessId, bp_thread.threadId, username, message FROM bp_thread_message inner join bp_user on bp_thread_message.userId = bp_user.userId  join bp_thread on bp_thread.threadId = bp_thread_message.threadID where reported = 1 and username = '$searchQuery' ";
            $result = $dbConn->prepare($query);
            $result->execute();
            $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);
            if (empty($recordSet)) {
                echo "<p style='text-align: center'>There are no new reported forum posts to address to. </p>";
            } else {
                echo "<div class='filterBar'>

        <form class='search-box' action='admin-reported-forum-posts.php' method='post'>
                <input type='text' name='searchQuery' style='width: 300px;' autocomplete='off' placeholder='Search users...' />
                <button type='submit' name='searchUser'><i class='material-icons'>search</i></button>
                <div class='result'></div><br>
            </form>
            
            <div class='clear'></div>
        </div>";
                echo"<table id=\"customers\">

        
          <tr>
            <th>Reported user</th>
            <th style=\"width:700px; max - width: 700px;\">Forum message posted</th>
            <th style=\"width:100px; max - width: 100px;\">View</th>
            <th style=\"width:100px; max - width: 100px;\">Suspend</th>
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
                <td><a class='button' style='margin: 0;'  href='suspend-reported-forum-reason.php?userId=$userID&threadMessId=$messageID' >Suspend user</a></td>
                <td><a class='button' style='margin: 0;'  href='ignore-forum-post.php?threadMessId=$messageID' >Ignore report</a></td>
              </tr>";
                }
            }
        } else {
            $query = "SELECT bp_user.userId, threadMessId, bp_thread.threadId, username, message FROM bp_thread_message inner join bp_user on bp_thread_message.userId = bp_user.userId  join bp_thread on bp_thread.threadId = bp_thread_message.threadID where reported = 1 ";
            $result = $dbConn->prepare($query);
            $result->execute();
            $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);
            if (empty($recordSet)) {
                echo "<p style='text-align: center'>There are no new reported forum posts to address to. </p>";
            } else {
                echo "<div class='filterBar'>

        <form class='search-box' action='maintain-roles.php' method='post'>
                <input type='text' name='searchQuery' style='width: 300px;' autocomplete='off' placeholder='Search users...' />
                <button type='submit' name='searchUser'><i class='material-icons'>search</i></button>
                <div class='result'></div><br>
            </form>
            
            <div class='clear'></div>
        </div>";
                echo"<table id=\"customers\">

        
          <tr>
            <th>Reported user</th>
            <th style=\"width:700px; max - width: 700px;\">Forum message posted</th>
            <th style=\"width:100px; max - width: 100px;\">View</th>
            <th style=\"width:100px; max - width: 100px;\">Suspend</th>
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
                <td><a class='button' style='margin: 0;'  href='suspend-reported-forum-reason.php?userId=$userID&threadMessId=$messageID' >Suspend user</a></td>
                <td><a class='button' style='margin: 0;'  href='ignore-forum-post.php?threadMessId=$messageID' >Ignore report</a></td>
              </tr>";
                }
            }
        }




    echo" </table>
    </div>";

} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("searchUsersReportedThreads.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>


