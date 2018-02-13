<?php
require_once ('scripts/functions.php');

echo startSession();
require_once ('classes/databaseConn.php');

echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
echo '<link rel="stylesheet"  type="text/css" href="css/style.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />';

if (isset($_SESSION['user']) != "") {
    echo "<h3> You are already logged in as " . $_SESSION['username'];
    echo "</br><a href='javascript:history.go(-1)'> Go Back </a>";
    echo "<form action='logout.php' method='get'>
              <input type='submit' value='Logout'>
              </form>";
}
else {
    echo '
    <div class="form-container">
        <form id="signup" name="signup" method="post" action="registerPage2Freelance.php">
            <label>Username: </label>
            <div class="form-block">
                <input type="text" name="username" class="form-control block" placeholder="Please enter a username" data-validation="length alphanumeric" data-validation-length="min4" data-validation="required">
                <label>Email: </label>
                <input type="text" name="Email" class="form-control block" placeholder="Please enter an email" data-validation="email" data-validation-length="min4">
                <label>Password: </label>
                <input type="password" name="password" class="form-control block"  data-validation="length alphanumeric" data-validation-length="min4" placeholder="Please enter a password">
                <label>Confirm Password: </label>
                <input type="password" name="confirmpassword" class="form-control block"  data-validation="alphanumeric" placeholder="Please confirm your password">
                <label>Password Hint: </label>
                <input type="text" name="passwordHint" class="form-control block"  data-validation="length alphanumeric" data-validation-length="min4" placeholder="Please enter a password hint">
                <br />

                <div class="submit-wrap">
                    <br />
                    <p>Please choose your account type by clicking on one of the options</p> </br>
                    Freelance: <input type="radio" name="accType[]" value="freelancer" checked="checked" onfocus="freelance()">
                    Client: <input type="radio" name="accType[]" value="client" onfocus="client()"><br />
                    <p style="text-align: center;">Please tick the checkbox if you agree with our <a href="#">terms and conditions</a></p></br>
                    <input type="checkbox" name="tandcbox" style="width: 30px; margin: 0 auto; display: block;" required>                    
                    <input type="submit" name="submit" value="Next" class="button">
                </div>
            </div>
        </form>
    </div>
    ';
};

?>
    <p style="text-align: center">Already have an account? <a href="login.php">Click here</a></p>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
        form : "#signup"
    });
        console.log(document.signup.action);
     function client() {
        document.signup.action = "registerPage2Client.php"; 
        console.log(document.signup.action);
    }

     function freelance() {
        document.signup.action = "registerPage2Freelance.php"; 
        console.log(document.signup.action);
    }
    </script>
<?php
    echo makePageFooter();
?>