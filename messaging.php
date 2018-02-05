<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Messages");
echo makeHeader();

echo "
  <div class='options'>
    <h1>Messages</h1>
  ";

$dbConn = databaseConn::getConnection();
if (isset($_SESSION['username'])) {
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];

  $convoSQL = "SELECT *
            FROM bp_conversation AS c
            LEFT JOIN bp_user AS u
            ON u.userId = c.startUserID
            WHERE c.startUserID = $userId
            OR c.secUserID = $userId";

  echo "
    <div class='options-left'>
      <input type=\"text\" name=\"message-search\" placeholder=\"Search\">
      <a href=\"#\">New conversation</a>
    </div>
    <div class=\"options-right\">
      <a href=\"#\">Report conversation</a>
      <a href=\"#\">Block user</a>
      <a href=\"#\">Delete Converation</a>
    </div>
  </div>
  ";

  if ($convostmt = $dbConn->query($convoSQL)) {
    $crows = $convostmt->fetchAll(PDO::FETCH_OBJ);
    $cnum_rows = count($crows);

    echo "
    <div class=\"container\">
      <div class=\"convo-panel\">
    ";

    if ($cnum_rows > 0) {
      foreach ($crows as $convo) {
        $ctime = "$convo->time";
        $ctimeString = strtotime($ctime);
        $cformatTime = date("h:i", $ctimeString);

        if ($userId == "$convo->startUserID") {
          $convoUserID = "$convo->secUserID";
        } elseif ($userId == "$convo->secUserID") {
          $convoUserID = "$convo->startUserID";
        } else {
          $convoUserID = "";
        }
        $convoNameSQL = "SELECT *
                  FROM bp_user
                  WHERE userId = $convoUserID";
        if ($convoNameStmt = $dbConn->query($convoNameSQL)) {
          $cnRow = $convoNameStmt->fetch(PDO::FETCH_OBJ);{
          $forename = $cnRow->forename;
          $surname = $cnRow->surname;
          }
        }
        if ($cnum_rows == 1) {
          $active = "convo-selected";
        } else {
          $active = "";
        }
        echo "
          <div class=\"convo-box $active\">
            <div class=\"convo-box-head\">
              <img src=\"images/userIcon.png\"/>
              <h2>$forename $surname</h2>
              <span>$cformatTime</span>
              <p>". $convo->lastMessage ."</p>
            </div>
          </div>
        ";
      }
    }
    $mSQL = "SELECT *
            FROM bp_message AS m
            LEFT JOIN bp_conversation AS c
            ON m.conversationID = c.conversationID
            WHERE m.conversationID = c.conversationID";
    echo "
      </div>
      <div class=\"messages\">
    ";

      if ($mstmt = $dbConn->query($mSQL)) {
        $mrows = $mstmt->fetchAll(PDO::FETCH_OBJ);
        $mnum_rows = count($mrows);

        if ($mnum_rows > 0) {
          foreach ($mrows as $mess) {
            $mtime = "$mess->time";
            $mtimeString = strtotime($mtime);
            $mformatTime = date("h:i", $mtimeString);
            if ($mess->muserID == $userId) {
              $status = "sent";
            } else {
              $status = "";
            }
            echo "
                <div class=\"chat $status\">
                  <div class=\"chat-content\">
                    <p>". $mess->message ."</p>
                  </div>
                </div>
            ";
          }
      }
      echo "
      </div>
      <div class=\"type-section\">
          <input type=\"text\" name=\"message-text\" id=\"message-text\" placeholder=\"Write something...\">
          <div class=\"enter-button\" href=\"#\">
            <p>-></p>
          </div>
          <div class=\"charaters-remaining\">
            <p>500 charaters remaining</p>
          </div>
        </div>
    </div>.
    ";
    } else {
      echo "
        <p style='text-align: center;'>You have no messages</p>
      </div>
      ";
    }
  } else {
    return notLoggedRedirect();
  }
}
echo makePageFooter();
?>
