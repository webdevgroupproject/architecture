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
$sql = "SELECT count(userId) FROM bp_user where userRole = 'freelancer'";
$result = $dbConn->prepare($sql);
$result->execute();
$freelancerUsers = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs function ----------//
$sql = "SELECT count(jobAcceptID) FROM bp_job_accept";
$result = $dbConn->prepare($sql);
$result->execute();
$numFreelancerJobsAccepted = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of pro users function ----------//
$sql = "SELECT count(userId) FROM bp_user where pro = 1 and userRole = 'freelancer'";
$result = $dbConn->prepare($sql);
$result->execute();
$proUsersFreelancer = $result->fetchColumn();
// ----------------------------------------------------//

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1> Freelancer statistics</h1><br/> ";
    echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total freelancer users <br/> $freelancerUsers</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center' ><b>Total freelancer jobs accepted <br/> $numFreelancerJobsAccepted</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 60px; margin-left:42%;'> <br><br><br><br>
                <p style='text-align: center'><b>Total premium freelancer users <br/> $proUsersFreelancer</b></p>
              </div>
            </div>
        </div>";


    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
                <h2>Lastest freelancer jobs accepted</h2>
                <table id=\"customers\">
                  <tr>
                    <th>Job title</th>
                    <th>Job description</th>
                   
                  </tr>";


    $query = "SELECT jobName, jobDesc from bp_job_post inner join bp_job_offer on bp_job_post.jobPostID = bp_job_offer.jobPostId inner join bp_job_accept on bp_job_offer.jobOfferId = bp_job_accept.jobOfferID LIMIT 3 ";
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
                    <h3 style='text-align: center'>New jobs accepted</h3>
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

