<?php
///////////////////////////////////////////////////////////////////////////////
// -------------Freelancer SQL statements for statistics page----------------//
///////////////////////////////////////////////////////////////////////////////

// ----------- Total Number of users function ----------//
$freelancerAll = "SELECT count(userId) FROM bp_user where userRole = 'freelancer'";
$freelancerAllResult = $dbConn->prepare($freelancerAll);
$freelancerAllResult->execute();
$freelancerUsers = $freelancerAllResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs function ----------//
$freelancerJobCount = "SELECT count(jobAcceptID) FROM bp_job_accept";
$freelancerJobCountResult = $dbConn->prepare($freelancerJobCount);
$freelancerJobCountResult->execute();
$numFreelancerJobsAccepted = $freelancerJobCountResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of pro users function ----------//
$freelancerPro = "SELECT count(userId) FROM bp_user where pro = 1 and userRole = 'freelancer'";
$freelancerProResult = $dbConn->prepare($freelancerPro);
$freelancerProResult->execute();
$proUsersFreelancer = $freelancerProResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users today function ----------//
$freelancerUsersToday = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE() and userRole = 'freelancer'";
$freelancerUsersTodayResult = $dbConn->prepare($freelancerUsersToday);
$freelancerUsersTodayResult->execute();
$freelancerusersTodayCount = $freelancerUsersTodayResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$freelancerUsers7days = "SELECT count(userId) FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() and userRole = 'freelancer'";
$freelancerUsers7daysResult = $dbConn->prepare($freelancerUsers7days);
$freelancerUsers7daysResult->execute();
$freelancerUsers7daysCount = $freelancerUsers7daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 30 days function ----------//
$freelancerUsers30Days = "SELECT count(userId)  FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND userRole = 'freelancer'";
$freelancerUsers30DaysResult = $dbConn->prepare($freelancerUsers30Days);
$freelancerUsers30DaysResult->execute();
$freelancerUsers30DaysCount = $freelancerUsers30DaysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted function ----------//
$freelancerJobAcceptToday = "SELECT count(jobAcceptID) FROM bp_job_accept where dateAccepted = CURDATE()";
$freelancerJobAcceptTodayResult = $dbConn->prepare($freelancerJobAcceptToday);
$freelancerJobAcceptTodayResult->execute();
$freelancerJobAcceptTodayCount = $freelancerJobAcceptTodayResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted during the last past 7 days function ----------//
$freelancerJobAccept7days = "SELECT count(jobAcceptID) FROM bp_job_accept WHERE dateAccepted BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$freelancerJobAccept7daysResult = $dbConn->prepare($freelancerJobAccept7days);
$freelancerJobAccept7daysResult->execute();
$freelancerJobAccept7daysCount = $freelancerJobAccept7daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs accepted during the last past 30 days function ----------//
$freelancerJobAccept30days = "SELECT count(jobAcceptID) FROM bp_job_accept WHERE dateAccepted > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()";
$freelancerJobAccept30daysResult = $dbConn->prepare($freelancerJobAccept30days);
$freelancerJobAccept30daysResult->execute();
$freelancerJobAccept30daysCount = $freelancerJobAccept30daysResult->fetchColumn();
// ----------------------------------------------------//


///////////////////////////////////////////////////////////////////////////////
// -------------Client SQL statements for statistics page--------------------//
///////////////////////////////////////////////////////////////////////////////

// ----------- Total Number of users function ----------//
$clientAll = "SELECT count(userId) FROM bp_user where userRole = 'client'";
$clientAllResult = $dbConn->prepare($clientAll);
$clientAllResult->execute();
$clientAllCount = $clientAllResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs function ----------//
$clientJobsCreated = "SELECT count(jobPostID) FROM bp_job_post ";
$clientJobsCreatedResult = $dbConn->prepare($clientJobsCreated);
$clientJobsCreatedResult->execute();
$clientJobsCreatedCount = $clientJobsCreatedResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of pro users function ----------//
$clientPro = "SELECT count(userId) FROM bp_user where pro = 1 and userRole = 'client'";
$clientProResult = $dbConn->prepare($clientPro);
$clientProResult->execute();
$clientProCount = $clientProResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users today function ----------//
$clientNumUsersall = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE() and userRole = 'client'";
$clientNumUsersallResult = $dbConn->prepare($clientNumUsersall);
$clientNumUsersallResult->execute();
$clientNumUsersallCount = $clientNumUsersallResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$clientNumUsers7days = "SELECT count(userId) FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() and userRole = 'client'";
$clientNumUsers7daysResults = $dbConn->prepare($clientNumUsers7days);
$clientNumUsers7daysResults->execute();
$clientNumUsers7dayscount = $clientNumUsers7daysResults->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$clientNumUsers30days = "SELECT count(userId) FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() and userRole = 'client'";
$clientNumUsers30daysResult = $dbConn->prepare($clientNumUsers30days);
$clientNumUsers30daysResult->execute();
$clientNumUsers30daysCount = $clientNumUsers30daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created function ----------//
$clientJobCreated7days = "SELECT count(jobPostID) FROM bp_job_post where dateAdded > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$clientJobCreatedAllResult = $dbConn->prepare($clientJobCreated7days);
$clientJobCreatedAllResult->execute();
$clientJobCreatedAllCount = $clientJobCreatedAllResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 7 days function ----------//
$clientJobCreated30days = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()";
$clientJobCreated30daysResults = $dbConn->prepare($clientJobCreated30days);
$clientJobCreated30daysResults->execute();
$clientJobCreated30daysCount = $clientJobCreated30daysResults->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 1 year function ----------//
$clientJobCreated1year = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 1 year) AND CURDATE() ";
$clientJobCreated1yearResult = $dbConn->prepare($clientJobCreated1year);
$clientJobCreated1yearResult->execute();
$clientJobCreated1yearCount = $clientJobCreated1yearResult->fetchColumn();
// ----------------------------------------------------//


///////////////////////////////////////////////////////////////////////////////////////
// -------------Admin homepage SQL statements for statistics page--------------------//
///////////////////////////////////////////////////////////////////////////////////////

// ----------- Total Number of users function ----------//
$adminAllUsers = "SELECT count(userId) FROM bp_user";
$adminAllUsersResults = $dbConn->prepare($adminAllUsers);
$adminAllUsersResults->execute();
$adminAllUsersCount = $adminAllUsersResults->fetchColumn();
// ----------------------------------------------------//
// ----------- Total Number of jobs function ----------//
$adminNumJobs = "SELECT count(jobPostID) FROM bp_job_post";
$adminNumJobsResult = $dbConn->prepare($adminNumJobs);
$adminNumJobsResult->execute();
$adminNumJobsCount = $adminNumJobsResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of pro users function ----------//
$adminNumProUsers = "SELECT count(userId) FROM bp_user where pro = 1";
$adminNumProUsersResult = $dbConn->prepare($adminNumProUsers);
$adminNumProUsersResult->execute();
$adminNumProUsersCount = $adminNumProUsersResult->fetchColumn();
// ----------------------------------------------------//


// ----------- Total Number of users function ----------//
$adminNumUsersToday = "SELECT count(userId) FROM bp_user where dateAdded = CURDATE()";
$adminNumUsersTodayResult = $dbConn->prepare($adminNumUsersToday);
$adminNumUsersTodayResult->execute();
$adminNumUsersTodayCount = $adminNumUsersTodayResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 7 days function ----------//
$adminNumUsers7days= "SELECT count(userId) FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$adminNumUsers7daysResult = $dbConn->prepare($adminNumUsers7days);
$adminNumUsers7daysResult->execute();
$adminNumUsers7daysCount = $adminNumUsers7daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of users during the last past 30 days function ----------//
$adminNumUsers30days = "SELECT count(userId) FROM bp_user WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() ";
$adminNumUsers30daysResult = $dbConn->prepare($adminNumUsers30days);
$adminNumUsers30daysResult->execute();
$adminNumUsers30daysCount = $adminNumUsers30daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created function ----------//
$adminJobsToday = "SELECT count(jobPostID) FROM bp_job_post where dateAdded = CURDATE()";
$adminJobsTodayResults = $dbConn->prepare($adminJobsToday);
$adminJobsTodayResults->execute();
$adminJobsTodayCount = $adminJobsTodayResults->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 7 days function ----------//
$adminJobsWeek = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$adminJobsWeekResult = $dbConn->prepare($adminJobsWeek);
$adminJobsWeekResult->execute();
$adminJobsWeekCount = $adminJobsWeekResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 30 days function ----------//
$adminJobsMonth = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAdded > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() ";
$adminJobsMonthResults = $dbConn->prepare($adminJobsMonth);
$adminJobsMonthResults->execute();
$adminJobsMonthCount = $adminJobsMonthResults->fetchColumn();
// ----------------------------------------------------//



// ----------- Total Number of jobs accepted function ----------//
$adminJobsAcceptToday = "SELECT count(jobAcceptID) FROM bp_job_accept where dateAccepted = CURDATE()";
$adminJobsAcceptTodayResults = $dbConn->prepare($adminJobsAcceptToday);
$adminJobsAcceptTodayResults->execute();
$adminJobsAcceptTodayCount = $adminJobsAcceptTodayResults->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 7 days function ----------//
$adminJobsAccept7days = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAccepted BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
$adminJobsAccept7daysResult = $dbConn->prepare($adminJobsAccept7days);
$adminJobsAccept7daysResult->execute();
$adminJobsAccept7daysCount = $adminJobsAccept7daysResult->fetchColumn();
// ----------------------------------------------------//

// ----------- Total Number of jobs created during the last past 30 days function ----------//
$adminJobsAccept30days = "SELECT count(jobPostID) FROM bp_job_post WHERE dateAccepted BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() ";
$adminJobsAccept30daysResults = $dbConn->prepare($adminJobsAccept30days);
$adminJobsAccept30daysResults->execute();
$adminJobsAccept30daysCount = $adminJobsAccept30daysResults->fetchColumn();
// ----------------------------------------------------//