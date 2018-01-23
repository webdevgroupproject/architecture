<?php
  require_once ('scripts/functions.php');
  echo startSession();
  require_once ('classes/databaseConn.php');
  echo makePageStart("viewport", "width=device-width, inital-scale=1", "Messaging");
  echo makeHeader();

?>
<style type="text/css">
  
  a {
      color: #1a0dab;
      text-decoration: underline;
  }

  h2 {
    font-size: 18px;
  }

  .options {
    border-bottom: 1px solid #CCC;
    padding: 10px;
  }

  .options a {
    margin: 5px;
    font-size: 14px;
  }

  .options input {
    border-radius: 20px;
    border: 1px solid #CCC;
  }

  .messages {
    /*background-color: #404040;*/
    padding: 0 4.95%;
    width: 60%;
    height: 400px;
    overflow-y: scroll;
  }

  .chat {
    -webkit-box-shadow: 3px 3px 4px 2px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
    -moz-box-shadow:    3px 3px 4px 2px #ccc;  /* Firefox 3.5 - 3.6 */
    box-shadow:         3px 3px 4px 2px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
    border: 1px solid #CCC;
    background-color: rgb(45, 195, 231);
    color: #f9f9f9;
    width: 70%;
    padding: 20px;
    margin: 20px auto;
    display: flex;
    border-radius: 20px;
    float: left;
  }

  .sent {
    float: right;
    background-color: #f9f9f9;
    color: #000;
  }

  .options-left {
    float: left;
  }

  .options-right {
    float: right;
  }

  .type-section {
    padding: 0 4.95%;
    width: 60%;
    display: inline-block;
    border-top: 1px solid #CCC;
    height: 100px;
  }

  .type-section input {
    margin-top: 20px;
    padding-bottom: 40px;
    border-radius: 20px;
    border: 1px solid #CCC;
  }

  .charaters-remaining {
    color: #ccb;
    float: right;
    display: inline-block;
    font-size: 12px;
    margin: 5px 10%;
  }

  .enter-button {
    width: 5%;
    background-color: #003;
    color: #fff;
    text-align: center;
    display: inline-block;
  }

  #message-text {
    width: 90%;
  }
  .convo-panel {
    width: 30%;
    border-right: 1px solid #CCC;
    float: left;
    height: 500px;
    overflow-y: scroll;
  }

  .convo-box {
    border-bottom: 1px solid #CCC;
    display: block;
  }

  .convo-selected {
    background-color: rgb(45, 195, 231);
    color: #f9f9f9;
  }

  .convo-box img {
    max-height: 75px;
    max-width: 75px;
    margin: 20px;
    display: inline-block;
    float: left;
  }

  .convo-box-head {
    display: inline-block;
    width: 100%;
  }
  .convo-box-head h2 {
    display: inline-block;
    margin-top: 5%;
    float: left;
  }

  .convo-box-head p {
    display: inline-block;
    font-size: 12px;
    float: left;
    width: 60%
  }

  .convo-box-head span {
    display: inline-block;
    margin: 7% 5% 0 0;
    font-size: 12px;
    float: right;
  }
</style>
  <div class="options">
    <h1>Messaging</h1>
    <div class="options-left">
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