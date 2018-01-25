<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Create account");
echo makeHeader();
?>
<html>
    <head>
        <link rel="stylesheet"  type="text/css" href="css/style.css">

        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />
    </head>
    <body>
    <br/><br/><h1>Create your account</h1>
    <div class="form-container">
        <form class="login-form" method="post" action="Create-Account-Page-2-Client.php">
            <label>Username: </label>
            <div class="form-block">
                <input type="text" name="username" class="form-control block" placeholder="Please enter a username" data-validation="length alphanumeric" data-validation-length="min4" data-validation="required" data-validation-help="Please enter a username">
                <label>Email: </label>
                <input type="text" name="Email" class="form-control block" placeholder="Please enter an email" data-validation="email" data-validation-length="min4">
                <label>Password: </label>
                <input type="password" name="password" class="form-control block" placeholder="Please enter a password"  data-validation="length alphanumeric" data-validation-length="min4">
                <label>Confirm Password: </label>
                <input type="password" name="confirmpassword" class="form-control block" placeholder="Please confirm your password"  data-validation="alphanumeric">
                <label>Password Hint: </label>
                <input type="text" name="passwordhint" class="form-control block" placeholder="Please enter a password hint"  data-validation="length alphanumeric" data-validation-length="min4">
                <br>
                <input type="checkbox" name="tandcbox" class="termsandcondbox"><p style="text-align: center" class="termsandcondbox">Tick the box to confirm you have read and agree with our <a href="#">terms and conditions</a></p>
                <div class="submit-wrap">
                  <br>
                    <div class="radio-group">
                        <input type="radio" id="option-one" name="selector" value="option-one">
                        <label for="option-one">Freelancer</label>
                        <input type="radio" id="option-two" name="selector" value="option-two">
                        <label for="option-two">Client</label>
                </div>

            <br>
            <br>
            <input type="submit" value="Next" class="button">
            </div>
        </div>
    </form>
    </div>
    <br>
    <p style="text-align: center">Already have an account? <a href="login.php">Click here</a></p>
    <br>
    <br>
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
    </body>
</html>
