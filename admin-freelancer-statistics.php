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
require_once('scripts/admin-stats-functions.php');

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1> Freelancer statistics</h1><br/> ";

    echo "
        <div class='filterBar'>
            <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center'><b>Total number of freelancer users: <br/> $freelancerUsers</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center' ><b>Total number of jobs accepted by freelancers: <br/> $numFreelancerJobsAccepted</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 60px; margin-left:42%;'> <br><br>
                <p style='text-align: center'><b>Total number of premium freelancer users: <br/> $proUsersFreelancer</b></p>
              </div>
            <div class='clear'></div>
        </div>"; // end of filter bar


    echo "<div class=\"images-container\" style='width:95%'>
            <div class=\"imageHalfContain\" style='margin-left:5%; width:45%'>
                <h2>Description of latest jobs accepted</h2>
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

    echo " </table>
                </div>

            <div class=\"imageHalfContain\" style='margin-left:5%; width:45%'>
                <h2>Daily statistics</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Total number of freelancer users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>$freelancerusersTodayCount <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>$freelancerUsers7daysCount <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>$freelancerUsers30DaysCount <br/> This month</b></p>
                  </div>
                </div>
                
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>Total number of jobs accepted by freelancers</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>$freelancerJobAcceptTodayCount <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>$freelancerJobAccept7daysCount <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>$freelancerJobAccept30daysCount <br/> This month</b></p>
                  </div>
                </div>
            </div>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>

