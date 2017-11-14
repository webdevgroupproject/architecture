
<?php
require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
<!--<script src="scripts/checkForm.js"></script>-->


      <br/><br/><h1>Sign into your account</h1>
        <div class="form-container">
            <form method="post" id="myForm" action="loginAction.php">
                <label>Email / Username: </label>
                <div id='username' style="color: red;"></div>
                <input type="text" name="email" id="username1" onblur="validate('username', this.value)" required >

                <label>Password: </label>
                <div id='password' style="color: red;"></div>
                <input type="password" name="password" id="password1" onblur="validate('password', this.value)" required>

                <div class="submit-wrap">
                  <input type="submit"   value="Login" class="button">
                </div>
            </form>
        </div>
        <p style="text-align: center"><a href="#">Sign up</a>   |  <a href="#">Forgot password</a> </p>

<?php
echo makePageFooter();
?>
