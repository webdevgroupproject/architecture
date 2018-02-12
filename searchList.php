<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Listings");
echo makeHeader();

$search = filter_has_var(INPUT_GET, 'searchInput') ? $_GET['searchInput'] : null;
$searchChoice = filter_has_var(INPUT_GET, 'searchChoice') ? $_GET['searchChoice'] : null;
$search = filter_var($search, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$filter = filter_has_var(INPUT_GET, 'filter') ? $_GET['filter'] : null;

$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$pro = checkProStatus();
if (isset($searchChoice)){
  if ($searchChoice == 'freelancer' || $searchChoice == 'client') {
    if (empty($search)) {
      $searchSQL = "SELECT *
              FROM bp_user
              WHERE userRole = '$searchChoice'
              ORDER BY '$filter'";
    } else {
      $searchSQL = "SELECT *
               FROM bp_user
               WHERE forename LIKE '%$search%'
               OR surname LIKE '%$search%'
               OR email LIKE '%$search%'
               AND userRole = '$searchChoice'
               ORDER BY '$filter'";
    }

    echo "
      <h1>Search results</h1>
      <div class='searchFilter'>
        <form method='get' action='searchList.php'>
          <legend>Filters</legend>
          <span>
            <input type='radio' name='filter' value='forename ASC' checked/>
            <label for='filterA-Z'>Forename - A to Z</label>
          </span>
          <span>
            <input type='radio' name='filter' value='surname ASC'/>
            <label for='filter'>Surname - A to Z</label>
          </span>
          <span>
            <input type='radio' id='filterRole' name='filter' value='forename ASC'/>
            <label for='filterRole'>By role</label>
          </span>
          <span>
            <input type='radio' id='filterSkill' name='filter' value='forename ASC'/>
            <label for='filterSkill'>By skill</label>
          </span>
          <input type='text' name='searchInput' style='display:none;' value='$search'/>
          <input type='text' name='searchChoice' style='display:none;' value='$searchChoice'/>
          <input type='submit' class='button'>
        </form>
      </div>
    ";

    if ($searchstmt = $dbConn->query($searchSQL)) {
     $srows = $searchstmt->fetchAll(PDO::FETCH_OBJ);
     $snum_rows = count($srows);
     echo "
       <div class='searchResults'>
     ";

     if ($snum_rows > 0) {
       foreach ($srows as $listing) {
         $id = $listing->userId;
         $forename = $listing->forename;
         $surname = $listing->surname;
         $email = $listing->email;
         $profilePic = $listing->image;
         $org = $listing->organisation;
         $local = $listing->location;
         $oView = $listing->overview;

         if ($listing->pro == 1) {
           $pro = "star";
         } else {
           $pro = "";
         }

         echo "
            <div class='flSearch'>
              <img src=$profilePic/>
              <div class='listing-body'>
                <span class='heading'>
                  <h2>$forename $surname</h2>
                  <i class=\"material-icons\">$pro</i>
                </span>
                <p>Email: $email</p>
                <p>Organisation: $org</p>
                <p>Location: $local</p>
                <p>Description: $oView</p>
              </div>
              <div class='listing-buttons'>
                <form method='get' action='profile.php?userID=$id'>
                  <input type='submit' class='button' href='profile.php' value='View'/>
                </form>
                <form method='get' style='float: right !important;' action='messaging.php?userID=$id'>
                  <input type='submit' class='button' value='Message'/>
                </form>
              </div>
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

    echo "
      <h1>Search results</h1>
      <div class='searchFilter'>
        <form>
          <legend>Filters</legend>
          <span>
            <input type='radio' id='filterA-Z' name='filterA-Z' value='A-Z'/>
            <label for='filterA-Z'>A to Z</label>
          </span>
          <span>
            <input type='radio' id='filterHourly' name='filterHourly' value='Hourly'/>
            <label for='filterHourly'>By £/hour</label>
          </span>
          <span>
            <input type='radio' id='filterRole' name='filterRole' value='Role'/>
            <label for='filterRole'>By role</label>
          </span>
          <span>
            <input type='radio' id='filterSkill' name='filterSkill' value='Skill'/>
            <label for='filterSkill'>By skill</label>
          </span>
          <input type='submit' class='button'>
        </form>
      </div>
    ";

    if ($searchstmt = $dbConn->query($searchSQL)) {
     $srows = $searchstmt->fetchAll(PDO::FETCH_OBJ);
     $snum_rows = count($srows);
     echo "
       <div class='searchResults'>
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
           <div class='jSearch'>
             <img src=''/>
             <h2>$name</h2>
             <p>Job description: $desc</p>
             <p>Location: $location</p>
             <p>Duration: $duration</p>
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
