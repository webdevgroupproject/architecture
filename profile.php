<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();

if ($userType == "client") {
  echo "

  <div class=\"profilewrapper\">
    <img class='profilebg' src=\"images/newcastlebackground.jpg\">
    <div class=\"profilebgcontent\">
      <img id=\"profilepicture\" src=\"images/profilepicture.jpg\" />
      <h2 class=\"profilepagename\">Jodi Clark</h2>
      <p class=\"profilepagelocation\">Newcastle upon Tyne</p>

      <div class=\"form-container-profile\">
        <a href=\"notifications.php\" class=\"button\">Notifications</a>
        <a href= \"jobForm.php\" class=\"button\">Post a Job</a>
        <a href= \"messaging.php\" class=\"button\">Messages</a>
      </div>
    </div>
  </div>

  <h3 id=\"activejobtitle\">My Active Job Posts</h3>

  <p id=\"rcorners1\">Newcastle Public House Build</p>
  <p id=\"rcorners2\">EDIT DELETE</p>

  <p id=\"rcorners1\">Landscape Request</p>
  <p id=\"rcorners2\">EDIT DELETE</p>


  <br>
  <br>
  <br>

  ";}
  else if ($userType == "freelancer") {
    # code...
  }
  else if ($userType == "admin") {
      // ----------- Total Number of users function ----------//
      $sql = "SELECT count(userId) FROM bp_user";
      $result = $dbConn->prepare($sql);
      $result->execute();
      $totalNumberUsers = $result->fetchColumn();
// ----------------------------------------------------//
      // ----------- Total Number of jobs function ----------//
      $sql = "SELECT count(jobPostID) FROM bp_job_post";
      $result = $dbConn->prepare($sql);
      $result->execute();
      $numberOfJobs = $result->fetchColumn();
    // ----------------------------------------------------//

    // ----------- Total Number of pro users function ----------//
          $sql = "SELECT count(userId) FROM bp_user where pro = 1";
          $result = $dbConn->prepare($sql);
          $result->execute();
          $proUsers = $result->fetchColumn();
    // ----------------------------------------------------//


    // ----------- Total Number of users function ----------//
          $sql = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE()";
          $result = $dbConn->prepare($sql);
          $result->execute();
          $numberOfUserstoday = $result->fetchColumn();
    // ----------------------------------------------------//

    //// ----------- Total Number of users function ----------//
    //$sql = "SELECT count(userId) FROM bp_user where dateAdded = DATE_ADD(CURDATE(), INTERVAL - 7 DAY); ";
    //$result = $dbConn->prepare($sql);
    //$result->execute();
    //$numOfUsersWeek = $result->fetchColumn();
    //// ----------------------------------------------------//

    //// ----------- Total Number of users function ----------//
    //$sql = "SELECT count(userId) FROM bp_user where dateAdded = DATE_ADD(CURDATE(), INTERVAL - 1 MONTH); ";
    //$result = $dbConn->prepare($sql);
    //$result->execute();
    //$numOfUsersMonth = $result->fetchColumn();
    //// ----------------------------------------------------//
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
            <h2>Heading</h2>
               <p style='text-align:justify'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

                </p> <br/>

                <p style='text-align:justify'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

                </p>

                <a href='admin-client-statistics.php' class='button'>Client statistics</a>
                <a href='admin-freelancer-statistics.php' class='button'>Freelancer statistics</a>
            </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics for all user types</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>$numberOfUserstoday <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >10 <br/> <b>This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>10 <br/> <b>This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Jobs accepted</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>10 <br/> <b>Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >10 <br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>10 <br/><b> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New jobs created</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>10 <br/><b> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' >10 <br/><b> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'>10 <br/><b> This month</b></p>
                  </div>
                </div>
            </div>";
  }

echo makePageFooter();

//Profile Banner Image Source: https://www.architecture.com/
