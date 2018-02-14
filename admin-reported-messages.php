<?php
//define the number of rows to return per page
define("ROW_PER_PAGE", 10);
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin reported messages");
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
            width: 340px;
        }

        .refine-box {
            float: right;
            width: 400px;
            display: inline-block;
            position: relative;

        }

        .imageHalfContain {
            width: 45%;
            margin-left: 5%;
        }

        #customers {
            width: 85%;
            margin-left: 100px;
        }

    </style>
<?php

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1>Reported conversation messages</h1><br/> ";


    echo "<div class='images-container' style='width: 90%; margin-left:5%;'>";

    $userNameSearch = isset($_REQUEST["userNameSearch"]) ? $_REQUEST["userNameSearch"] : null;

    $query = "SELECT bp_user.userId, messageID, username, message, conversationID FROM bp_message inner join bp_user on bp_message.userID = bp_user.userId where 1 and reported = 1 ";
    $sqlCondition = ' ';
    if (!empty($userNameSearch)) {
        $sqlCondition .= " and username LIKE '%$userNameSearch%'";
    }
    $per_page_html = '';
    $page = 1;
    $start = 0;
    if (!empty($_POST["page"])) {
        $page = $_POST["page"];
        $start = ($page - 1) * ROW_PER_PAGE;
    }
    $limit = " limit " . $start . "," . ROW_PER_PAGE;
    $pagination_statement = $dbConn->prepare($query);
    $pagination_statement->execute();

    $row_count = $pagination_statement->rowCount();
//if there are results returned
    if (!empty($row_count)) {
        //add html to display the pagination links in a div to a variable
        $per_page_html .= "<div class='pag-links'>";
        if ($row_count > ROW_PER_PAGE) {
            $per_page_html .= "<span style='margin-right: 10px;'>Pg</span>";
        }
        //divide the number of rows by the number of rows per page to get the page count
        $page_count = ceil($row_count / ROW_PER_PAGE);
        //if the page count is bigger than 1 show the pagination links
        if ($page_count > 1) {
            for ($i = 1; $i <= $page_count; $i++) {
                if ($i == $page) {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button pag-button-current" />';
                } else {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button" />';
                }
            }
        }
        $per_page_html .= "</div>";
    }
    $sqlSearch = $query . $sqlCondition . $limit;
    $result = $dbConn->prepare($sqlSearch);
    $result->execute();
    $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);
    if (empty($recordSet)) {
        echo "<p style='text-align: center'>There are no new reported forum posts to address to. </p>";
    } else {
        echo "<div class='filterBar'>

         <form action='admin-reported-messages.php' method='post'>
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
            <th style=\"width:100px; max - width: 100px;\">Suspend and delete</th>
            <th style=\"width:100px; max - width: 100px;\">Ignore</th>
          </tr>";
        foreach ($recordSet as $row) {
            $messageID = $row['messageID'];
            $conversationID = $row['conversationID'];
            $userID = $row['userId'];
            echo "<tr>
                <td>$row[username]</td>
                <td>$row[message]</td>
                <td><a class='button' style='margin: 0;' href='admin-view-messages.php?messageID=$messageID&convoID=$conversationID'>View message</a></td>
                <td><a class='button' style='margin: 0;'  href='deleteReportedMessage.php?messageID=$messageID&convoID=$conversationID' >Delete message</a></td>
                <td><a class='button' style='margin: 0;'  href='suspend-report-reason.php?userId=$userID&messageID=$messageID' >Suspend and delete</a></td>
                <td><a class='button' style='margin: 0;'  href='ignore-messages.php?messageID=$messageID' >Ignore report</a></td>
              </tr>";
        }


    }


    echo " </table><br><form name='frmSearch' action='' method='post' class=\"pag-form\">
        $per_page_html
    </form>
    </div>";

} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>
