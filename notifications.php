<?php
    require_once ('scripts/functions.php');
    echo startSession();
    require_once ('classes/databaseConn.php');
    echo makePageStart("viewport", "width=device-width, inital-scale=1", "Notification");
    echo makeHeader();

    echo "<h1>Notifications</h1>";

        $dbConn = databaseConn::getConnection();
            if (isset($_SESSION['username'])) {
                $userId = $_SESSION['userId'];

                $notifSQL = "SELECT *
                            FROM bp_notification
                            WHERE userID = '$userId'";

                $stmt = $dbConn->query($notifSQL);

                while ($notif = $stmt->fetchObject()) {
                  echo "
                    <div class=\"notif\"> <!--The whole notifications section -->
                      <div class=\"notif-box\"> <!--single notification-->
                        <div class=\"notif-box-unread\"> <!--unread notification-->
                          <p>" . $event->time ."</p>
                        </div>
                        <div class=\"notif-box-content\">
                          <h2 class=\"notif-box-header\">Bob Jones has sent you a job offer</h2>
                          <a href=\"" . $event->link ."\">Click here to see the offer</a>
                        </div>
                        <div class=\"notif-box-dismiss\">
                          <a href=\"#\">Dismiss</a>
                        </div>
                      </div>
                    </div>
                  ";
                }
            }
?>
<style type="text/css">
  
  a {
        color: #1a0dab;
        text-decoration: underline;
  }

  .notif {
    /*background-color: #404040;*/
    padding: 20px;
    width: 50%;
    margin: auto;
  }

  .notif-box {
    -webkit-box-shadow: 3px 3px 4px 2px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
    -moz-box-shadow:    3px 3px 4px 2px #ccc;  /* Firefox 3.5 - 3.6 */
    box-shadow:         3px 3px 4px 2px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
    border: 1px solid #CCC;
    background-color: #f9f9f9;
    width: 75%;
    margin: 20px auto;
    height: 90px;
    display: flex;
    border-radius: 20px;
  }

  .notif-box-unread {
    background-color: rgb(45, 195, 231);
    float: left;
    padding: 0 20px;
    color: #FFF;
    line-height: 90px;
    font-size: 14px;
    margin-right: 5%;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
  }

  .notif-box-read {
    background-color: #f9f9f9;
    float: left;
    padding: 0 20px;
    line-height: 90px;
    font-size: 14px;
    margin-right: 5%;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
  }

  .notif-box-header {
    font-size: 18px;
  }

  .notif-box-dismiss {
    float: left;
    line-height: 90px;
    font-size: 14px;
    margin: auto;
  }
</style>
  <h1>Notifications</h1>
  <div class="notif"> <!--The whole notifications section -->
    <div class="notif-box"> <!--single notification-->
      <div class="notif-box-unread"> <!--unread notification-->
        <p>16:33</p>
      </div>
      <div class="notif-box-content">
        <h2 class="notif-box-header">Bob Jones has sent you a job offer</h2>
        <a href="#">Click here to see the offer</a>
      </div>
      <div class="notif-box-dismiss">
        <a href="#">Dismiss</a>
      </div>
    </div>
    <div class="notif-box"> <!--single notification-->
      <div class="notif-box-read"> <!--unread notification-->
        <p>16:33</p>
      </div>
      <div class="notif-box-content">
        <h2 class="notif-box-header">Bob Jones has sent you a job offer</h2>
        <a href="#">Click here to see the offer</a>
      </div>
      <div class="notif-box-dismiss">
        <a href="#">Dismiss</a>
      </div>
    </div>
  </div>

<?php
  echo makePageFooter();
?>