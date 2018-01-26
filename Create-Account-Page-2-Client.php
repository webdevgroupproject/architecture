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

<br/><br/><h1>Personal Details</h1>
<div class="form-container">
    <form method="get" class="login-form" action="Create-Account-Page-3-Client.php">
        <label>Forename: </label>
        <input type="text" name="username" class="form-control block" placeholder="Please enter your Forename" data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required" data-validation-help="Please enter a Forename">
        <label>Surname: </label>
        <input type="text" name="surname" class="form-control block" placeholder="Please enter your Surname" data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required" data-validation-help="Please enter a Surname">
        <label>Location: </label>
        <input type="text" name="location" class="form-control block" placeholder="Please enter your current location" data-validation="length alphanumeric" data-validation-length="min4 data" data-validation="required" data-validation-help="Please enter a location">
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
