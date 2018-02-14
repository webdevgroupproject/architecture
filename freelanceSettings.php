<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();

echo "<link href='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css'
      rel='stylesheet' type='text/css' />
      <style>
      .login-form {
        margin-top: 70px;  
      }

      textarea {
        resize: none;
      }
      </style>";
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
//require_once('scripts/admin-stats-functions.php');

$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null; //checks that the eventID is set/has been passed

if (isset($_SESSION['username']) && $_SESSION['userType'] == "freelancer") {

  $freelanceSQL = "SELECT * FROM bp_user WHERE userId = '$userID'"; 

  if ($stmt = $dbConn->query($freelanceSQL)) {
    $row = $stmt->fetch(PDO::FETCH_OBJ); {
      $forename = $row->forename;
      $surname = $row->surname;
      $location = $row->location;
      $email = $row->email;
      $overview = $row->overview;
    }


    echo "<form class='login-form' action='updateUser.php' method='get'>
            <input type='hidden' name='userIdentification' value='$userID'>
            <label>Forename: </label><input type='text' name='forename' value='$forename' data-validation='length alphanumeric' data-validation-length='min4 data' data-validation='required'>
            <label>Surename: </label><input type='text' name='surname' value='$surname' data-validation='length alphanumeric' data-validation-length='min4 data' data-validation='required'>
            <label>Location: </label><input type='text' name='location' value='$location' data-validation='length alphanumeric' data-validation-length='min4 data' data-validation='required'>
            <label>Email: </label><input type='text' name='email' value='$email' data-validation='length alphanumeric' data-validation-length='min4 data' data-validation='required'>
            <label>Professional Overview: </label> <textarea type='text' name='proOverview' id='overview' data-validation-length='min10 data' data-validation='required' rows='6' cols='65' placeholder='$overview'></textarea><span id='maxlength'>500</span> characters left
            <input type='submit' class='button' name='update' value='Update Account' style='float: right; width: 170px'>
          </form>

          <script>
            $.validate({
              form : '.login-form'

            });
            $('#overview').restrictLength($('#maxlength'));
          </script>
          <script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
          <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js'></script>
          <script>";
  }
}

checkUserType();
