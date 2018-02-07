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

trim($username);
trim($password);
trim($passHint);
trim($email);

$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$passHint = filter_var($passHint, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$_SESSION['username'] = $username;
$_SESSION['password'] = $passwordHash;
$_SESSION['email'] = $email; 
$_SESSION['passHint'] = $passHint; 
?>
<html>
<head>
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
      margin-right: 10px;
      vertical-align: bottom;
    }

    .skillCont {
      display: inline-block;
      width: 31%;
      float: left;
      margin-bottom: 10px;
      margin-left: 10px;
      }

    .skillCont label {
      display: block;
      text-indent: -25px;
      background: linear-gradient(to left, #f9f9f9 51%, #2DC3E7 49%);
      background-size: 200% 100%;
      background-position:right bottom;
      transition:all 2s ease;
      margin-right: 10px;
    }

    .skillCont input {
      width: 25px;
      height: 25px;
      padding: 0;
      margin: 0;
      margin-right: 15px;
      vertical-align: bottom;
      position: relative;
      top: -1px;
      *overflow: hidden;

    
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

    </style>
</head>
<body>
<br/>
<br/>
<h1>Freelance Sign up Details</h1>
<div class="form-container">
    <form method="get" class="login-form" action="registerFreelance.php">

        <!-- Personal Details Section -->
        <h2>Personal Details</h2>

        <label>Forename: </label>
        <input type="text" name="username" class="form-control block" placeholder="Please enter your Forename"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required"
               data-validation-help="Please enter a Forename">

        <label>Surname: </label>
        <input type="text" name="surname" class="form-control block" placeholder="Please enter your Surname"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required"
               data-validation-help="Please enter a Surname">

        <label>Location: </label>
        <input type="text" name="location" class="form-control block" placeholder="Please enter your current location"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required"
               data-validation-help="Please enter a location">
        
        <!-- Professional Background Section -->
        <h2>Professional Details</h2>
        <h3>Choose your skillsets</h3>
        <div id="skillSets">
        <?php 
          $sql = "SELECT * FROM bp_skill_type"; 

          $conn = databaseConn::getConnection();

          $stmt = $conn->query($sql);

          while ($skills = $stmt->fetchObject()) {
            echo "<div class='skillCont'> 
                    
                     <label><input class='skillsChk' name='skillsets[]' type='checkbox' value='$skills->skillTypeId'/>$skills->skillType</label>
                  </div>
            ";
          };

        ?>
      </div>
      

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
</script>
<?php

?>
</body>
</html>


