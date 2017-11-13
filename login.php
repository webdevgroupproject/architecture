
<?php
require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>


      <br/><br/><h1>Sign into your account</h1>
        <div class="form-container">
            <form method="get" action="loginAction.php">
                <label>Email / Username: </label>
                <input type="text" name="email">
                <label>Password: </label>
                <input type="password" name="password">
                <div class="submit-wrap">
                  <input type="submit" value="Login" class="button">
                </div>
            </form>
        </div>
        <p style="text-align: center"><a href="#">Sign up</a>   |  <a href="#">Forgot password</a> </p>

<?php
echo makePageFooter();
?>
