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
trim($passHint);
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

<br/>
<br/>
<h1>Client Sign up Details</h1>
<br>
<br>
<div class="form-container">
    <form method="post" class="login-form" action="registerPage2ClientAction.php">

        <!-- Personal Details Section -->
        <h3>Personal Details</h3>
        <br>

        <label>Forename: &#42;</label>
        <input type="text" name="forename" class="form-control block" placeholder="Please enter your Forename"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Surname: &#42;</label>
        <input type="text" name="surname" class="form-control block" placeholder="Please enter your Surname"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Location: &#42;</label>
        <input type="text" name="location" class="form-control block" placeholder="Please enter your current location"
               data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required">

        <label>Profile Picture: </label>
        <input style="padding: 0;" type="file" name="image">

        <!-- Organisational Details Section -->
        <h3>Organisational Details</h3>
        <br>

        <label>Organisation Name: </label>
        <input type="text" name="organName" class="form-control block" placeholder="Optional: Enter your organisation name">

        <label>Organisation Overview: </label>
        <textarea id="organdesc" name="organOverview" class="form-control block" placeholder="Optional: Information about your company">
        </textarea>

        <label>Website Link: </label>
        <input type="text" name="webLink" class="form-control block" placeholder="Optional: Enter your organisation name">


        <!--<p style="text-align: center" class="skipthisstep"><a href="Create-Account-Page-4-Membership1.php">
               Skip this step </a>- You can always add this information later from inside your Account Settings Page!</p>-->

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
echo makePageFooter();
?>
