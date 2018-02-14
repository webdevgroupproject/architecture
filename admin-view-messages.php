<?php
    require_once ('scripts/functions.php');
    echo startSession();
    require_once ('classes/databaseConn.php');
    echo makePageStart("viewport", "width=device-width, inital-scale=1", "View messages ");
    echo makeHeader();

    echo "<h1>Repoted messages</h1>";

    $dbConn = databaseConn::getConnection();
    if (isset($_SESSION['username'])) {
      $convoID = filter_has_var(INPUT_GET, 'convoID') ? $_GET['convoID'] : null;

      $mSQL = "SELECT *
              FROM bp_message AS m
              INNER JOIN bp_user AS u
              ON m.UserID = u.userId
              WHERE conversationID = '$convoID'";

      if ($mstmt = $dbConn->query($mSQL)) {
        $mrows = $mstmt->fetchAll(PDO::FETCH_OBJ);
        $mnum_rows = count($mrows);

        if ($mnum_rows > 0) {
          foreach ($mrows as $mess) {
            $mtime = "$mess->time";
            $mtimeString = strtotime($mtime);
            $mformatTime = date("h:i", $mtimeString);
            $messID = $mess->messageID;
            $messUser = $mess->UserID;
            $forename = $mess->forename;
            $surname = $mess->surname;
            echo "
              <div class='admin-messages'>
                <h2>$forename $surname</h2>
                <div class=\"chat\">
                  <div class=\"chat-content\">
                    <p>". $mess->message ."</p>
                  </div>
                </div>
              </div>
            ";
          }
      }
      echo "
        </div>
      ";
    }
  }

  echo makePageFooter();
?>
