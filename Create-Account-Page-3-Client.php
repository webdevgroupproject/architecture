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

<br/><br/><h1>Organisational Details</h1>
<div class="form-container">
    <form method="get" class="login-form" action="Create-Account-Page-4-Membership1.php">
        <label>Organisation Name: </label>
        <input type="text" name="organisationmame" class="form-control block"
               placeholder="Optional: Enter your organisation name"
               data-validation="length alphanumeric" data-validation-length="min4 data"
               data-validation="required" data-validation-help="Optional: Enter your organisation name">
        <label>Organisation Overview: </label>
        <textarea style="max-width: 100%; width: 100%; height: 120px; box-sizing: border-box;"
                  name="organoverview" class="form-control block"
                  placeholder="Optional: Information about your company"
                  data-validation="length alphanumeric" data-validation-length="min4 data"
                  data-validation="required" data-validation-help="Optional: Information about your company"></textarea>
        <label>Website Link: </label>
        <input type="text" name="weblink" class="form-control block" placeholder="Optional: Enter your organisation name"
               data-validation="length alphanumeric" data-validation-length="min4 data"
               data-validation="required" data-validation-help="Optional: Enter your organisation name">
        <br>
        <br>
        <p style="text-align: center" class="skipthisstep"><a href="Create-Account-Page-4-Membership1.php">
                  Skip this step </a>- You can always add this information later from inside your Account Settings Page!</p>
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
