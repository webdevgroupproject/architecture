<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
require_once('scripts/admin-stats-functions.php');

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
        <a href= \"editProfile.php\" class=\"button\">Edit Profile</a>
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

  ";
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
