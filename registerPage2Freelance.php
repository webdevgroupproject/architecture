<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['Email']; 
$passHint = $_POST['passwordHint'];
$accType = $_POST['accType'];

trim($username);
trim($password);
trim($email);

$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$passHint = filter_var($passHint, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$_SESSION['regUsername'] = $username;
$_SESSION['password'] = $passwordHash;
$_SESSION['email'] = $email; 
$_SESSION['passHint'] = $passHint; 
$_SESSION['accType'] = $accType; 

?>
    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />

    <style>
    #skillSets {

      width: 160%;
      margin-left: -13%;
      margin-bottom: 20px;
    }

    .skillsChk {
      width: 20px;
      vertical-align: bottom;
    }

    .skillCont {

      width: 30%;
      float: left;
      margin-bottom: 10px;
      margin-left: 15px;
      }

    .skillCont label {
      width: 100%;
      height: 25px;
      text-indent: -20px;
      margin: 0;
      background: linear-gradient(to left, #f9f9f9 51%, #2DC3E7 49%);
      background-size: 250% 100%;
      background-position:right bottom;
      transition:all 2s ease;
      float: right;
    }

    .skillCont input {
      width: 19.5%;
      height: 25px;
      left: -5%;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: -1px;
      *overflow: hidden;
      float: left;

    
}
    .skillCont label:hover {
      background-position:left bottom;
    }

    .form-container {
      min-height: 100%;
    }

    .form-container h2, h3 {
      text-align: center;
    }

    strong {
      width: 100%;
      margin: 0 auto;
    }
    </style>

<h1>Freelance Sign up Details</h1>
<div class="form-container">
    <form method="post" class="login-form" action="registerFreelance.php">

        <!-- Personal Details Section -->
        <h2>Personal Details</h2>

        <label>Forename: </label>
        <input type="text" name="forename" class="form-control block" placeholder="Please enter your Forename"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Surname: </label>
        <input type="text" name="surname" class="form-control block" placeholder="Please enter your Surname"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Location: </label>
        <input type="text" name="location" class="form-control block" placeholder="Please enter your current location"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Profile Picture: </label>
        <input style="padding: 0;" type="file" name="image">
        
        <!-- Professional Background Section -->
        <h2>Professional Details</h2>
        <label>Choose your skillsets:</label><br><br>
        <div id="skillSets">
        <?php 
          $sql = "SELECT * FROM bp_skill_type"; 

          $conn = databaseConn::getConnection();

          $stmt = $conn->query($sql);

          while ($skills = $stmt->fetchObject()) {
            echo "<div class='skillCont'> 
                    <label>$skills->skillType
                     <input class='skillsChk' name='skillsets[]' type='checkbox' value='$skills->skillTypeId'/></label>
                  </div>
            ";
          };

        ?>
      </div>
      
      <label style="font-weight: bold;">Please write a few words for your professional overview:</label>
      <textarea type="text" name="proOverview" id="overview" placeholder="Enter your professional overview" data-validation-length="min10 data" data-validation="required" rows="6" cols="65"></textarea><span id="maxlength">500</span> characters left
      

        <div class="submit-wrap">
            <br>
            <input type="submit" value="Next" class="button">
        </div>
    </form>
</div>
<br>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $.validate({
    form : ".login-form"

});
    $('#overview').restrictLength($('#maxlength'));
</script>
<?php
    makePageFooter();
?>



