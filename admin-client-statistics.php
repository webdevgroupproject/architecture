<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbConn = databaseConn::getConnection();

// ----------- Total Number of users function ----------//
$sql = "SELECT count(userId) FROM bp_user where userRole = 'client'";
$result = $dbConn->prepare($sql);
$result->execute();
$totalClients = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs function ----------//
$sql = "SELECT count(jobPostID) FROM bp_job_post ";
$result = $dbConn->prepare($sql);
$result->execute();
$numClientJobsCreated = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of pro users function ----------//
$sql = "SELECT count(userId) FROM bp_user where pro = 1 and userRole = 'client'";
$result = $dbConn->prepare($sql);
$result->execute();
$proUsersClient = $result->fetchColumn();
// ----------------------------------------------------//

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1> Client statistics</h1><br/> ";
    echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total client users <br/> $totalClients</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center' ><b>Total client jobs created <br/> $numClientJobsCreated</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total premium client users <br/> $proUsersClient</b></p>
              </div>
            </div>
        </div>";

    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
                <h2>Latest new client jobs created</h2>
                <table id=\"customers\">
                  <tr>
                    <th>Job title</th>
                    <th>Job description</th>
                   
                  </tr>";


                $query = "SELECT jobName, jobDesc FROM bp_job_post ";
                $result = $dbConn->prepare($query);
                $result->execute();
                $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recordSet as $row) {

                echo "<tr>
                        <td>$row[jobName]</td>
                        <td>$row[jobDesc]</td>
                      </tr>";
                }

           echo" </table>
                </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New users</h3>
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

