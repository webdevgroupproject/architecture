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
                FROM bp_message
                left join bp_conversation 
                on bp_message.userId=bp_conversation.userId
                WHERE userID = '$userId'";
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

    if ($stmt = $dbConn->query($convoSQL)) {
      $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
      $num_rows = count($rows);

      if ($num_rows > 0) {
        foreach ($rows as $convo) {
          $time = "$convo->time";
          $timeString = strtotime($time);
          $formatTime = date("h:ia", $timeString);
          echo "
          <div class=\"container\">
              <div class=\"convo-panel\">
                <div class=\"convo-box convo-selected\">
                  <div class=\"convo-box-head\">
                    <img src=\"images/userIcon.png\"/>
                    <h2>$username</h2>
                    <span>$time</span>
                    <p>I've typed somekind of message to you in this chat box</p>
                  </div>
                </div>
              </div>
          ";
        }
        echo "
        <div class=\"messages\">
          <div class=\"chat\">
            <div class=\"chat-content\">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
          <div class=\"chat sent\">
            <div class=\"chat-content\">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
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
  echo makePageFooter();
?>  