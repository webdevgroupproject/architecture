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

                if ($stmt = $dbConn->query($notifSQL)) {
                  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
                  $num_rows = count($rows);

                  if ($num_rows > 0) {
                    foreach ($rows as $notif) {
                      $time = "$notif->time";
                      $timeString = strtotime($time);
                      $formatTime = date("h:ia", $timeString);
                      if ($notif->markRead == 0) {
                        $status = "unread";
                      } else {
                        $status = "read";
                      }
                      echo "
                        <div class=\"notif\"> <!--The whole notifications section -->
                          <div class=\"notif-box\"> <!--single notification-->
                            <div class=\"notif-box-$status\">
                              <p>$formatTime</p>
                            </div>
                            <div class=\"notif-box-content\">
                              <h2 class=\"notif-box-header\">Bob Jones has sent you a job offer</h2>
                              <a href=\"". $notif->link ."\">Click here to see the offer</a>
                            </div>
                            <div class=\"notif-box-dismiss\">
                              <a href=\"#\" onclick=removeNotif($notif->notificationID)>Dismiss</a>
                            </div>
                          </div>
                        </div>
                      ";
                    }
                  } else {
                    echo "<p style='text-align: center;'>You have no notifications</p>";
                  }
                }
              } else {
                return notLoggedRedirect();
                echo "<p style='text-align: center;'>You shouldn't be seeing this page</p>";
              }

  echo makePageFooter();
?>
