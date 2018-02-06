<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<head>
    <link rel="stylesheet"  type="text/css" href="css/style.css">

    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
rel="stylesheet" type="text/css" />
</head>

<br/>
<br/>
<h1>Client Sign up Details</h1>
<div class="form-container">
    <form method="get" class="login-form" action="Create-Account-Page-2-Client.php">

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

        <!-- Organisational Details Section -->
        <h2>Organisational Details</h2>

        <label>Organisation Name: </label>
        <input type="text" name="organName" class="form-control block" placeholder="Optional: Enter your organisation name"
               data-validation="length alphanumeric" data-validation-length="min4 data"
               data-validation="required">

        <label>Organisation Overview: </label>
        <textarea id="organdesc" name="organOverview" class="form-control block" placeholder="Optional: Information about your company"
                  data-validation="length alphanumeric" data-validation-length="min4 data"
                  data-validation="required"></textarea>

        <label>Website Link: </label>
        <input type="text" name="webLink" class="form-control block" placeholder="Optional: Enter your organisation name"
               data-validation="length alphanumeric" data-validation-length="min4 data"
               data-validation="required">

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
