<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Messages");
echo makeHeader();

echo "
    <h1 style=\"display:none;\">Messages</h1>
  ";

$dbConn = databaseConn::getConnection();
if (isset($_SESSION['username'])) {
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
  $activeID = filter_has_var(INPUT_GET, 'activeID') ? $_GET['activeID'] : null;

  $convoSQL = "SELECT *
            FROM bp_conversation AS c
            INNER JOIN bp_user AS u
            ON u.userId = c.startUserID
            WHERE c.startUserID = $userId
            OR c.secUserID = $userId";

  if ($convostmt = $dbConn->query($convoSQL)) {
    $crows = $convostmt->fetchAll(PDO::FETCH_OBJ);
    $cnum_rows = count($crows);
    $convoID = '';

    echo "
    <div class=\"container\">
      <div class=\"convo-panel\">
    ";

    if ($cnum_rows > 0) {
      foreach ($crows as $convo) {
        $ctime = "$convo->time";
        $ctimeString = strtotime($ctime);
        $cformatTime = date("h:i", $ctimeString);
        $convoID = $convo->conversationID;

        if ($userId == "$convo->startUserID") {
          $convoUserID = "$convo->secUserID";
        } elseif ($userId == "$convo->secUserID") {
          $convoUserID = "$convo->startUserID";
        } else {
          $convoUserID = "";
        } if ($activeID == null) {
          $activeID = $convo->conversationID;
        }

        $convoNameSQL = "SELECT *
                  FROM bp_user
                  WHERE userId = $convoUserID";

        if ($convoNameStmt = $dbConn->query($convoNameSQL)) {
          $cnRow = $convoNameStmt->fetch(PDO::FETCH_OBJ);{
          $forename = $cnRow->forename;
          $surname = $cnRow->surname;
          $profilePic = $cnRow->image;
          }
        }

        if ($activeID == $convoID) {
          $active = "convo-selected";
        } else {
          $active = "";
        }

        echo "
            <div class=\"convo-box $active\">
              <a href='messaging.php?activeID=$convoID'>
                <div class=\"convo-box-head\">
                  <img src=\"images/$profilePic\"/>
                  <h2>$forename $surname</h2>
                  <span>$cformatTime</span>
                  <p>". $convo->lastMessage ."</p>
                </div>
              </a>
            </div>
        ";
      }
    } else {
      echo "<p class='empty'>You have no Converations, search for more people</p>";
    }
    if ($activeID == '') {
      $activeID = '1';
    }
    $mSQL = "SELECT *
            FROM bp_message AS m
            LEFT JOIN bp_conversation AS c
            ON m.conversationID = c.conversationID
            WHERE m.conversationID = $activeID";
    echo "
      </div>
      <div class=\"options\">
        <div class='options-left'>
          <form class=\"search-box\" method='get' action=\"newConvo.php\">
            <input type='text' autocomplete=\"off\" name='newConversation' placeholder='Start new conversation with...'/>
            <button type='submit'><i class=\"material-icons\">add</i></button>
            <div class='result'></div>
          </form>
        </div>
        <div class=\"options-right\">
          <a href=\"deleteConvo.php?conversationID=$activeID\">Delete Converation</a>
        </div>
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
            $messID = $mess->messageID;
            $messUser = $mess->UserID;
            if ($messUser == $userId) {
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
                <div class=\"options-right\" style='width:40%;'>
                  <a style='float:right; margin-right:5%;' href=\"deleteMessage.php?messageID=$messID&convoID=$activeID\">Delete</a>
                  <a style='float:right; margin-right:5%;' href=\"reportMessage.php?messageID=$messID&convoID=$activeID\">Report</a>
                </div>
            ";
          }
      } else {
        echo "
          <p class='empty'>You have no messages</p>
        ";
      }
      echo "
        </div>
      ";
    }
    echo "
      <form method='get' action='postMessage.php' class=\"type-section\">
          <textarea name=\"message-text\" cols='40' rows='5' onkeyup=\"countChar(this)\" id=\"message-text\" placeholder=\"Write something...\"></textarea>
          <input type='disabled' style='display:none;' name='messConvoID' value=\"$activeID\"/>
          <button type='submit'><i class=\"material-icons\">keyboard_return</i></button>
          <div id='charNum' class=\"charaters-remaining\">
          </div>
      </form>
    </div>
    ";
  } else {
    return notLoggedRedirect();
  }
}
?>
<script src="http://code.jquery.com/jquery-1.5.js"></script>
<script>
    $(document).ready(function(){
        $(".dropdown").change(function(){
            $("#orderEventsForm").submit();
        });
    });
    //source - https://stackoverflow.com/questions/5371089/count-characters-in-textarea
    function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(500 - len + ' charaters remaining');
        }
      };
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("searchUsers.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result li", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text  ());
            $(this).parent(".result").empty();
        });
    });
</script>
<?php
echo makePageFooter();
?>
