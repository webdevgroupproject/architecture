<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint profile");
echo makeHeader();

echo "<link href='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css' rel='stylesheet' type='text/css' />
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

//$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null; //checks that the eventID is set/has been passed
$userID = $_SESSION['userId'];

if (isset($_SESSION['username'])) {

  $freelanceSQL = "SELECT * FROM bp_user WHERE userId = '$userID'";

  if ($stmt = $dbConn->query($freelanceSQL)) {
    $row = $stmt->fetch(PDO::FETCH_OBJ); {
      $forename = $row->forename;
      $surname = $row->surname;
      $location = $row->location;
      $email = $row->email;
      $overview = $row->overview;
    }

    echo"<h1>Profile Settings</h1>";

    echo "<form id='fSettings' action='updateUser.php' method='get'>
            <input type='hidden' name='userIdentification' value='$userID'>
            <label>Forename: </label><input type='text' name='forename' value='$forename'  data-validation-length='min4 data' data-validation='required'>
            <label>Surename: </label><input type='text' name='surname' value='$surname'  data-validation-length='min4 data' data-validation='required'>
            <label>Location: </label><input type='text' name='location' value='$location'  data-validation-length='min4 data' data-validation='required'>
            <label>Email: </label><input type='text' name='email' value='$email' data-validation='email' data-validation-length='min4 data' data-validation='required'>
            <label>Professional Overview: </label> <textarea type='text' name='proOverview' id='overview' data-validation-length='min10 data' data-validation='required' rows='6' cols='65'>$overview</textarea><span id='maxlength'>500</span> characters left
            <input type='submit' class='button' name='update' value='Update Account' style='float: right; width: 170px'>
          </form>";
?>

          <div id='settingBtns' style="width: 30%; display:block; margin-top: 60px; margin-right: auto; margin-left: auto; text-align: center; padding-bottom: 50px;">
          <span style="font-weight: bold; font-size: 1.5em;">Upgrade</span>
          <a href="cardDetails.php" class='button' name='upgradeBtn'>Upgrade To Pro</a>

          </div>

          <script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
          <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js'></script>
          <script>
            $.validate({
              form : "#fSettings"

            });
            $('#overview').restrictLength($('#maxlength'));
          </script>
<?php
  }
}

echo makePageFooter();
checkUserType();
?>
