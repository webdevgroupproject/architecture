<?php
    require_once ('scripts/functions.php');
    echo startSession();
    require_once ('classes/databaseConn.php');
    echo makePageStart("viewport", "width=device-width, inital-scale=1", "Notification");
    echo makeHeader();

    echo "
      <div class='options'>
        <h1>Messages</h1>
        <div class='options-left'>
      ";

    $dbConn = databaseConn::getConnection();
        if (isset($_SESSION['username'])) {
            $userId = $_SESSION['userId'];

            $notifSQL = "SELECT *
                        FROM bp_notification
                        WHERE userID = '$userId'";

?>
      <input type="text" name="message-search" placeholder=" Search">
      <a href="#">New conversation</a>
    </div>
    <div class="options-right">
      <a href="#">Report conversation</a>
      <a href="#">Block user</a>
      <a href="#">Delete Converation</a>
    </div>
  </div>

  <div class="container">
    <div class="convo-panel">
      <div class="convo-box convo-selected">
        <div class="convo-box-head">
          <img src="images/userIcon.png"/>
          <h2>John boi</h2>
          <span>21:00</span>
          <p>I've typed somekind of message to you in this chat box</p>
        </div>
      </div>
      <div class="convo-box">
        <div class="convo-box-head">
          <img src="images/userIcon.png"/>
          <h2>John boi</h2>
          <span>21:00</span>
          <p>I've typed somekind of message to you in this chat box</p>
        </div>
      </div>
      <div class="convo-box">
        <div class="convo-box-head">
          <img src="images/userIcon.png"/>
          <h2>John boi</h2>
          <span>21:00</span>
          <p>I've typed somekind of message to you in this chat box</p>
        </div>
      </div>
      <div class="convo-box">
        <div class="convo-box-head">
          <img src="images/userIcon.png"/>
          <h2>John boi</h2>
          <span>21:00</span>
          <p>I've typed somekind of message to you in this chat box</p>
        </div>
      </div>
      <div class="convo-box">
        <div class="convo-box-head">
          <img src="images/userIcon.png"/>
          <h2>John boi</h2>
          <span>21:00</span>
          <p>I've typed somekind of message to you in this chat box</p>
        </div>
      </div>
    </div>

    <div class="messages"> <!--The whole notifications section -->
      <div class="chat"> <!--single notification-->
        <div class="chat-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <div class="chat sent"> <!--single notification-->
        <div class="chat-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <div class="chat"> <!--single notification-->
        <div class="chat-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </div>
    <div class="type-section">
        <input type="text" name="message-text" id="message-text" placeholder="  Write something...">
        <div class="enter-button" href="#">
          <p>-></p>
        </div>
        <div class="charaters-remaining">
          <p>500 charaters remaining</p>
        </div>
      </div>
  </div>

<?php
  echo makePageFooter();
?>