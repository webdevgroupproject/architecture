<?php
require_once ('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$jobID = htmlspecialchars($_GET["jobPostID"]);
$dbConn = databaseConn::getConnection();
$editJobSQL = "SELECT *
             FROM bp_job_post
             WHERE jobPostID = '$jobID'";
$jobQuery = $dbConn->query($editJobSQL);
while ($job = $jobQuery->fetchObject()) {
    $jobID=$job->jobPostID;
    $jobName=$job->jobName;
    $workDesc=$job->jobDesc;
    $jobLocation=$job->jobLoc;
    $payMethod=$job->payMethod;
    $budget=$job->budget;
    $jobDuration=$job->duration;
    $startDate=$job->startDate;
    $endDate=$job->endDate;

echo "

<h1>Job Application Form</h1>
<br>
<div class=\"form-container\">
    <form method=\"get\" class=\"login-form\" action=\"updateJobAction.php\">

        <!-- Job Description Section -->
        <fieldset>

            <legend><h3>Describe the Job</h3></legend>

            <input type=\"text\" name=\"jobID\" value=\"$jobID\" style=\"display: none;\">

            <label>Name your job posting: </label>
            <input type=\"text\" name=\"jobName\" class=\"form-control block\" placeholder=\"Example: Housing Extension Request\"
                   data-validation-length=\"min4 data\" data-validation=\"required\" value=\"$jobName\">

            <label>Describe the work to be done: </label>
            <input type=\"text\" name=\"workDesc\" class=\"form-control block\" placeholder=\"Use this area to provide details about your project\"
                   data-validation-length=\"min4 data\" data-validation=\"required\" value=\"$workDesc\">

            <label>Job Location: </label>
            <input type=\"text\" name=\"jobLocation\" class=\"form-control block\" placeholder=\"Example: Newcastle upon Tyne\"
                   data-validation-length=\"min4 data\" data-validation=\"required\" value=\"$jobLocation\">

        </fieldset>

        <!-- Rate and Availability Section -->
        <fieldset>
            <legend><h3>Rates and Availability</h3></legend>

            <label>How would you like to pay: </label>
            <select name=\"payMethod\">
              <option value=\"daily\">Daily</option>
              <option value=\"weekly\">Weekly</option>
              <option value=\"monthly\">Monthly</option>
              <option value=\"quarterly\">Quarterly</option>
              <option value=\"yearly\">Yearly</option>
            </select>
            <br>
            <br>

            <label>Budget: </label>
            <input type=\"text\" name=\"budgetType\" class=\"form-control block\" placeholder=\"Example: £100\"
                   data-validation-length=\"min2 data\" data-validation=\"required\" value=\"$budget\">

            <label>Job Duration: </label>
            <input type=\"text\" name=\"jobDuration\" class=\"form-control block\" placeholder=\"Example: 6 Months\"
                   data-validation-length=\"min4 data\" data-validation=\"required\" value=\"$jobName\">

        </fieldset>

        <!-- Dates and Deadlines-->
        <fieldset>
            <legend><h3>Dates and Deadlines</h3></legend>

            <label>Start Date: </label>
            <input type=\"date\" name=\"startDate\" class=\"form-control block\" placeholder=\"Example: 06/11/18\"
                   data-validation=\"required\" min=\"2018-02-07\" value=\"$startDate\">

            <label>End Date: </label>
            <input type=\"date\" name=\"endDate\" class=\"form-control block\" placeholder=\"Example: 20/02/19\"
                   data-validation=\"required\" min=\"2018-02-07\" value=\"$endDate\">

        </fieldset>

        <!-- Submit Button -->
        <div class=\"submit-wrap\">
            <br>
            <input type=\"submit\" value=\"Update\" class=\"button\">
        </div>
    </form>
</div>

";

}

echo makePageFooter();
