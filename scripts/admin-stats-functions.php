<?php
///////////////////////////////////////////////////////////////////////////////
// -------------Freelancer SQL statements for statistics page----------------//
///////////////////////////////////////////////////////////////////////////////

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

// ----------- Total Number of users today function ----------//
$sql = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE() and userRole = 'freelancer'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUserstoday = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() and userRole = 'freelancer'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers7days = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() and userRole = 'freelancer'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers30Days = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted function ----------//
$sql = "SELECT count(jobAcceptID) FROM bp_job_accept where dateAccepted = CURDATE()";
$result = $dbConn->prepare($sql);
$result->execute();
$jobAcceptedToday = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted during the last past 7 days function ----------//
$sql = "SELECT count(jobAcceptID) FROM bp_job_accept WHERE dateAccepted BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$result = $dbConn->prepare($sql);
$result->execute();
$jobAccepted7days = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted during the last past 30 days function ----------//
$sql = "SELECT count(jobAcceptID) FROM bp_job_accept WHERE dateAccepted BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()";
$result = $dbConn->prepare($sql);
$result->execute();
$jobAccepted30ays = $result->fetchColumn();
// ----------------------------------------------------//


///////////////////////////////////////////////////////////////////////////////
// -------------Client SQL statements for statistics page--------------------//
///////////////////////////////////////////////////////////////////////////////

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

// ----------- Total Number of users today function ----------//
$sql = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE() and userRole = 'client'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUserstoday = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() and userRole = 'client'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers7days = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() and userRole = 'client'";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers30Days = $result->fetchColumn();
// ----------------------------------------------------//


///////////////////////////////////////////////////////////////////////////////////////
// -------------Admin homepage SQL statements for statistics page--------------------//
///////////////////////////////////////////////////////////////////////////////////////

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

// ----------- Total Number of users during the last past 7 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers7days = $result->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 30 days function ----------//
$sql = "SELECT count(userId) FROM bp_user WHERE dateAdded BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() ";
$result = $dbConn->prepare($sql);
$result->execute();
$numberOfUsers30Days = $result->fetchColumn();
// ----------------------------------------------------//