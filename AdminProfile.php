<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin profile");
echo makeHeader();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$userType = checkUserType();
$username = $_SESSION['username'];

$dbConn = databaseConn::getConnection();

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

// ----------- Total Number of users function ----------//
$sql = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE() - INTERVAL 7 DAY";
$result = $dbConn->prepare($sql);
$result->execute();
$numOfUsersWeek = $result->fetchColumn();
// ----------------------------------------------------//


if (isset($_SESSION['username']) && ($userType == "admin")) {

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

<input type=\"submit\" value=\"Client statistics\" class=\"button\">
<input type=\"submit\" value=\"Freelancer statistics\" class=\"button\">
            </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics for all user types</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>$numberOfUserstoday <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>$numOfUsersWeek <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New premium users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>10 <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\"> 
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New jobs created</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>10 <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
            </div>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>

