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
checkUserType();
//require_once('scripts/admin-stats-functions.php');

$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null; //checks that the eventID is set/has been passed

if (isset($_SESSION['username']) && $_SESSION['userType'] == "client") {

  $clientSQL = "SELECT * FROM bp_user WHERE userId = '$userID'";

  if ($stmt = $dbConn->query($clientSQL)) {
    $row = $stmt->fetch(PDO::FETCH_OBJ); {
      $forename = $row->forename;
      $surname = $row->surname;
      $location = $row->location;
      $organName = $row->organisation;
      $organOverview = $row->overview;
      $webLink = $row->websiteLink;
      $image = $row->image;
    }

    echo "<form class='login-form' action='updateUser.php' method='get'>
            <input type='hidden' name='userIdentification' value='$userID'>

            <h1>Profile Settings</h1>

            <label>Forename: </label><input type='text' name='forename' value='$forename' data-validation='length alphanumeric'
             data-validation-length='min4 data' data-validation='required'>

            <label>Surname: </label><input type='text' name='surname' value='$surname' data-validation='length alphanumeric'
             data-validation-length='min4 data' data-validation='required'>

            <label>Location: </label><input type='text' name='location' value='$location' data-validation='length alphanumeric'
             data-validation-length='min4 data' data-validation='required'>

            <label>Email: </label><input type='text' name='email' value='$webLink' data-validation='length alphanumeric'
             data-validation-length='min4 data' data-validation='required'>

            <label>Website Link: </label><input style='padding: 0;' type='file' name='image' value='$image'>

            <label>Organisation Name: </label><input type='text' name='organName' value='$organName' data-validation='length alphanumeric'>

            <label>Organisation Overview: </label><textarea type='text' name='organName' value='$organOverview' data-validation='length alphanumeric'
             rows='7' cols='66' placeholder='$organOverview'></textarea>

            <label>Website Link: </label><input type='text' name='organName' value='$webLink'>

            <input type='submit' class='button' name='update' value='Update Account' style='float: right; width: 170px'>
          </form>";

?>

          <div id='settingBtns' style="width: 30%; display:block; margin-top: 60px; margin-right: auto; margin-left: auto; text-align: center; padding-bottom: 50px;">
              <span style="font-weight: bold; font-size: 1.5em;">Upgrade or Change Your Password</span>
              <a href="cardDetails.php" class='button' name='upgradeBtn'>Upgrade To Pro</a>
              <a href="forgotPasswordForm.php" class='button' name='changePassBtn'>Change Password</a>
          </div>

          <script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
          <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js'></script>
          <script>
            $.validate({
              form : '.login-form'

            });
            $('#overview').restrictLength($('#maxlength'));
          </script>
<?php
  }
}

echo makePageFooter();
