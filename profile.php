<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();
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
              $organName = $row->organName;
              $organOverview = $row->organOverview;
              $webLink = $row->webLink;
            }
          }

  echo "

  <div class=\"profilewrapper\">
    <img class='profilebg' src=\"images/newcastlebackground.jpg\">
    <div class=\"profilebgcontent\">
      <img id=\"profilepicture\" src=\"images/profilepicture.jpg\" />
      <h2 class=\"profilepagename\">$forename $surname</h2>
      <p class=\"profilepagelocation\">$location</p>

      <div class=\"form-container-profile\">
        <a href=\"notifications.php\" class=\"button\">Notifications</a>
        <a href= \"jobForm.php\" class=\"button\">Post a Job</a>
        <a href= \"messaging.php\" class=\"button\">Messages</a>
      </div>
    </div>
  </div>

  <h3 id=\"clientDetails\">Client Details</h3>

  <h3 id=\"activejobtitle\">My Active Job Posts</h3>
  ";
  $profileJobSQL = "SELECT *
              FROM bp_job_post
              WHERE userID = '$userId'";

  if ($stmt = $dbConn->query($profileJobSQL)) {
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);
    $num_rows = count(row);

    if ($num_rows > 0) {
      foreach ($row as $jobs) {
        $jobName = $jobs->jobName;

        echo "
        <p id=\"rcorners1\">$jobName</p>
        <p id=\"rcorners2\">EDIT DELETE</p>
        ";
      }
    }

  }

} else if ($userType == "freelancer") {
    # code...
} else if ($userType == "admin") {

    echo "<br><h1> Admin statistics</h1><br/> ";
    echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total website users: <br/>$totalNumberUsers</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center' ><b>Total active jobs <br/> $numberOfJobs</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total premium users <br/> $proUsers</b></p>
              </div>
            </div>
        </div>";
    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
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

            <div class=\"imageHalfContain\">
                <h2>Daily statistics for all user types</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Number of new users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$numberOfUserstoday <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >$numberOfUsers7days <br/> <b>This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$numberOfUsers30Days <br/> <b>This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Number of jobs accepted</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$jobAcceptedToday <br/> <b>Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >$jobAccepted7days <br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$jobAccepted30ays <br/><b> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New jobs created</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$numberOfjobstoday <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >$numberOfjobs7days <br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$numberOfjobs30Days <br/><b> This month</b></p>
                  </div>
                </div>
            </div>";
}
echo makePageFooter();

//Profile Banner Image Source: https://www.architecture.com/
