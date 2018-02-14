<?php
ob_start();
require_once ('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$jobID = filter_has_var(INPUT_GET, 'jobID') ? $_GET['jobID'] : null;
$jobName = filter_has_var(INPUT_GET, 'jobName') ? $_GET['jobName'] : null;
$workDesc = filter_has_var(INPUT_GET, 'workDesc') ? $_GET['workDesc'] : null;
$jobLocation = filter_has_var(INPUT_GET, 'jobLocation') ? $_GET['jobLocation'] : null;
$budgetType = filter_has_var(INPUT_GET, 'budgetType') ? $_GET['budgetType'] : null;
$jobDuration = filter_has_var(INPUT_GET, 'jobDuration') ? $_GET['jobDuration'] : null;
$startDate = filter_has_var(INPUT_GET, 'startDate') ? $_GET['startDate'] : null;
$endDate = filter_has_var(INPUT_GET, 'endDate') ? $_GET['endDate'] : null;

$jobName = filter_var($jobName, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$workDesc = filter_var($workDesc, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$jobLocation = filter_var($jobLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$budgetType = filter_var($budgetType, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$jobDuration = filter_var($jobDuration, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


    try {
        $dbConn = databaseConn::getConnection();
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $editJobSQL = "UPDATE bp_job_post
                  SET jobName = '$jobName',
                      jobDesc = '$workDesc',
                      jobLoc = '$jobLocation',
                      budget = '$budgetType',
                      duration = '$jobDuration',
                      startDate = '$startDate',
                      endDate = '$endDate'
                  WHERE jobPostID = '$jobID'";
        // use exec() because no results are returned
        $dbConn->exec($editJobSQL);

header("Location: profile.php");
// echo $jobName;
// echo $workDesc;
// echo $jobLocation;
// echo $budgetType;
// echo $jobDuration;
// echo $startDate;
// echo $endDate;

    }
    catch(PDOException $e) {
        echo $editJobSQLSql . "<br>" . $e->getMessage();
    }
