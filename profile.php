<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
require_once('scripts/admin-stats-functions.php');

if (isset($_SESSION['username']) && $userType == "client") {

  $dbConn = databaseConn::getConnection();
  $userId = $_SESSION['userId'];

          $profileInfoSQL = "SELECT *
                      FROM bp_user
                      WHERE userID = '$userId'";

          if ($stmt = $dbConn->query($profileInfoSQL)) {
            $row = $stmt->fetch(PDO::FETCH_OBJ); {
              $forename = $row->forename;
              $surname = $row->surname;
              $location = $row->location;
              $organName = $row->organisation;
              $organOverview = $row->overview;
              $webLink = $row->websiteLink;
              $image = $row->image;
            }
          }

  echo "

  <div class=\"profilewrapper\">
    <img class='profilebg' src=\"images/newcastlebackground.jpg\">
    <div class=\"profilebgcontent\">
  ";

  if ($image=="") {
    echo "<img id=\"profilepicture\" src=\"images/default_user.png\" />";
  }
  else {
    echo "<img id=\"profilepicture\" src=\"images/$image\" />";
  }

  echo "

      <h2 class=\"profilepagename\">$forename $surname</h2>
      <p class=\"profilepagelocation\">$location</p>

      <div class=\"form-container-profile\">
        <a href=\"notifications.php\" class=\"button\">Notifications</a>
        <a href= \"jobForm.php\" class=\"button\">Post a Job</a>
        <a href= \"messaging.php\" class=\"button\">Messages</a>
      </div>
    </div>
  </div>

  <div class=\"images-container clientContainer\">
    <h3 id=\"clientDetails\">Client Details</h3>
    <div class=\"imageThirdContain profileThird\">
      <h3 id=\"profileThirdPTitle\">Organisation Name</h3>
      <p>$organName</p>
    </div>
    <div class=\"imageThirdContain profileThird\">
      <h3 id=\"profileThirdPTitle\">Organisation Details</h3>
      <p>$organOverview</p>
    </div>
    <div class=\"imageThirdContain profileThird\">
      <h3 id=\"profileThirdPTitle\">Website</h3>
      <p>$webLink</p>
    </div>
  </div>

  <h2 id=\"activejobtitle\">My Active Job Posts</h2>
  ";

  echo "

  <div class=\"jobBoxContainer\">
  ";


  $profileJobSQL = "SELECT *
              FROM bp_job_post
              WHERE userID = '$userId'";

  if ($stmt = $dbConn->query($profileJobSQL)) {
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);
    $num_rows = count($row);

    if ($num_rows > 0) {
      foreach ($row as $jobs) {
        $jobName = $jobs->jobName;
        $jobLoc = $jobs->jobLoc;
        $startDate = $jobs->startDate;
        $endDate = $jobs->endDate;
        $jobPostID = $jobs->jobPostID;

        echo "
        <div class=\"jobBox\">
          <img src='Images/event-img-1.jpeg'/>
          <div class=\"jobBoxBody\">
            <span class=\"jobBoxHeading\">
              <h2>$jobName</h2>
            </span>
            <p>Location: $jobLoc</p>
            <p>Start date: $startDate</p>
            <p>End date: $endDate</p>
          </div>
          <div class=\"jobBoxButtons\">
          <form method='GET' action='editJobForm.php'>
            <input type='text' style='display:none;' name='jobPostID' value='$jobPostID'/>
            <input type=\"submit\" class=\"button\" value=\"Edit\"/>
          </form>
            <form method='GET' style=\"float: right !important;\"  action='jobDelete.php'>
              <input type='text' style='display:none;' name='jobPostID' value='$jobPostID'/>
              <input type=\"submit\" class=\"button\" value=\"Delete\"/>
            </form>
          </div>
        </div>
        ";
      }
    }
    else {
      echo "
      <p id=\"jobPostEcho\">No jobs have been posted yet</p>
      ";
    }

    echo "
      </div>
    ";

  }

} else if ($userType == "freelancer") {
    # code...
} else if ($userType == "admin") {

    echo "<br><h1> Admin statistics</h1><br/> ";
    echo "
        <div class='filterBar'>
            <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center'><b>Total website users: <br/> $adminAllUsersCount</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center' ><b>Total active jobs <br/> $adminNumJobsCount</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center'><b>Total premium users <br/> $adminNumProUsersCount</b></p>
              </div>
            <div class='clear'></div>
        </div>"; // end of filter bar

    echo "<div class=\"images-container\" style='width:95%'>
            <div class=\"imageHalfContain\" style='margin-left:5%; width:45%'>
            <h2>Admin functionality</h2>
               <p style='text-align:justify'>
               The admin functionality will allow you to find out some relevant information regarding the useage of the website
               and the users that are currently on the website. Such as finding out how many users have signed up to Blueprint
               within the last day, week and month also find out how many users are on the website altogether. The amount of Blueprint
               pro users would allow you to find out whether users are willing to pay the extra fees to boost their experience and business goals on
               the Blueprint website. find out how many jobs have been created and have been accepted by users on the website during
               a day, week also a month.
                </p> <br/>

                 <p style='text-align:justify'>
                The admin functionality allows admins to suspend any user accounts which have been reported for offences through
                the fourms or direct messages between users themselves. Delete any user accounts which are no longer needed and also
                create new admin accounts for new administrators of the website.
                </p> <br/>

                <a href='admin-client-statistics.php' class='button'>Client statistics</a>
                <a href='admin-freelancer-statistics.php' class='button'>Freelancer statistics</a>
            </div>

            <div class=\"imageHalfContain\" style='margin-left:5%; width:45%'>
                <h2>Daily statistics for all user types</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Number of new users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$adminNumUsersTodayCount <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >$adminNumUsers7daysCount <br/> <b>This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$adminNumUsers30daysCount <br/> <b>This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Number of jobs created</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$adminJobsTodayCount <br/> <b>Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >$adminJobsWeekCount <br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$adminJobsMonthCount <br/><b> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Number of jobs accepted</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$adminJobsAcceptTodayCount <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' > $adminJobsAccept7daysCount<br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'> $adminJobsAccept30daysCount<br/><b> This month</b></p>
                  </div>
                </div>
            </div>";
}
echo makePageFooter();

//Profile Banner Image Source: https://www.architecture.com/
