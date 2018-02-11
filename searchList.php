<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Listings");
echo makeHeader();

$search = filter_has_var(INPUT_GET, 'searchInput') ? $_GET['searchInput'] : null;
$searchChoice = filter_has_var(INPUT_GET, 'searchChoice') ? $_GET['searchChoice'] : null;
$search = filter_var($search, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$pro = checkProStatus();
if (isset($searchChoice)){
  if ($searchChoice == 'freelancer' || $searchChoice == 'client') {
    if (empty($search)) {
      $searchSQL = "SELECT *
              FROM bp_user
              WHERE userRole = '$searchChoice'";
    } else {
      $searchSQL = "SELECT *
               FROM bp_user
               WHERE forname LIKE '%$search%'
               OR surname LIKE '%$search%'
               OR email LIKE '%$search%'
               AND userRole = '$searchChoice'
               order by forname ASC";
    }

    echo "<h1>Search results</h1>";

    if ($searchstmt = $dbConn->query($searchSQL)) {
     $srows = $searchstmt->fetchAll(PDO::FETCH_OBJ);
     $snum_rows = count($srows);
     echo "
       <div>
     ";

     if ($snum_rows > 0) {
       foreach ($srows as $listing) {
         $forename = $listing->forename;
         $surname = $listing->surname;
         $email = $listing->surname;

         echo "
           <div>
             <img src=''/>
             <h2>$forename $surname</h2>
             <p>$email</p>
           </div>
         ";
       }
     }
     echo "
       </div>
     ";
    }
  } elseif ($searchChoice == 'jobs') {
    $searchSQL = "select *
             from bp_job_post
             WHERE jobName LIKE '%$search%'
             order by jobName ASC";

    echo "<h1>Search results</h1>";

    if ($searchstmt = $dbConn->query($searchSQL)) {
     $srows = $searchstmt->fetchAll(PDO::FETCH_OBJ);
     $snum_rows = count($srows);
     echo "
       <div>
     ";

     if ($snum_rows > 0) {
       foreach ($srows as $listing) {
         $name = $listing->jobName;
         $desc = $listing->jobDesc;
         $location = $listing->jobLoc;
         $budget = $listing->budget;
         $duration = $listing->duration;
         $date = $listing->dateAdded;

         echo "
           <div>
             <img src=''/>
             <h2>$name</h2>
             <p>$desc</p>
             <p>$location</p>
             <p>$duration</p>
           </div>
         ";
       }
     }
     echo "
       </div>
     ";
    }
  }
}

echo makePageFooter();
?>
