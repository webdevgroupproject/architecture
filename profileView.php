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

$userId = filter_has_var(INPUT_GET, 'userId') ? $_GET['userId'] : null;

if ($userId==null) {
  echo "<p style=\"text-align: center; margin-top: 70px;\">This isn't a valid user</p>

    <a  style=\"margin: 0 auto;
      text-align: center;
      display: block;
      width: 5%;
      padding: 15px;
      margin-top: 20px;\" href= \"index.php\" class=\"button\">Home</a>

  ";
}

else {
  $dbConn = databaseConn::getConnection();

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
                $profileUserType = $row->userRole;
              }
            }

             if ($profileUserType=="client") {
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
                    <p clasos=\"profilepagelocation\">$location</p>

                    <div class=\"form-container-profile\">

                  ";

                  if ($userType=="notLoggedIn") {
                    echo "<a href= \"login.php\" class=\"button\">Message</a>";
                  }

                  else {
                    echo "<a href= \"messaging.php\" class=\"button\">Message</a>";
                  }

              echo "

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

              <h2 id=\"activejobtitle\">Active Jobs</h2>
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
                      <form method='GET' action='#'>
                        <input type='text' style='display:none;' name='jobPostID' value='$jobPostID'/>
                        <input type=\"submit\" class=\"button\" value=\"Apply\"/>
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
       }else if ($profileUserType=="freelancer") {
         $profileInfoSQL = "SELECT *
                      FROM bp_user
                      WHERE userId = $userId";

          if ($stmt = $dbConn->query($profileInfoSQL)) {
            $row = $stmt->fetch(PDO::FETCH_OBJ); {
              $forename = $row->forename;
              $surname = $row->surname;
              $proOverview = $row->overview;
              $location = $row->location;
              $image = $row->image;
            }
          }
 echo "<div class=\"profilewrapper\">
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
        <a href= \"searchList.php?searchChoice=jobs&searchInput=\" class=\"button\">Find a Job</a>
        <a href= \"freelanceSettings.php?userID=$userId\" class=\"button\">Settings</a>
      </div> 
    </div>
  </div>

  <div class=\"images-container clientContainer\">
    <div class=\"imageThirdContain profileThird\">
    </div>
    <div class=\"imageThirdContain profileThird\">
      <h3 id=\"profileThirdPTitle\">Professional Overview</h3>
      <p style='word-break: break-all;'>$proOverview</p>
    </div>
    <div class=\"imageThirdContain profileThird\">
    </div>
  </div>
  <div class=\"jobs\">
  <h3>Job Applications</h3>";

  $getAppsSQL = "SELECT * FROM bp_job_accept AS a INNER JOIN bp_job_post AS b ON a.jobPostID = b.jobPostID WHERE a.userId = $userId";

    echo "</div>
          <div class=\"images-container skills\">
          <h3>Skills</h3>
          ";

    $getSkillsSQL = "SELECT * FROM bp_skills AS s1 INNER JOIN bp_skill_type AS s2 ON s1.skillTypeId = s2.skillTypeId WHERE s1.userId = $userId";

    if ($stmt = $dbConn->query($getSkillsSQL)) {
      $row = $stmt->fetchAll(PDO::FETCH_OBJ);
      $num_rows = count($row);
      if ($num_rows > 0) {
        foreach ($row as $skills)  {
          $skillName = $skills->skillType;

          echo "
          <span class=\"skillContainer\">$skillName</span>
          ";
        }
      }
    }
       }
}



echo makePageFooter();
