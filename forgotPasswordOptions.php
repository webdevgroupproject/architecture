<?php
ob_start(); // need to keep this in as I was having issues with headers already sent. This function allows it to continue.

require_once('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint Forgot password");
echo makeHeader();
    if (isset($_POST['updatePassword'])) {
        $option = isset($_REQUEST['selector']) ? $_REQUEST['selector'] : '';

        if ($option == "option-one") {
            header("Location: forgotPasswordForm.php");
        }else if ($option == "option-two") {
            header("Location: forgotPasswordReminderForm.php");
        }
    }
?>


<style>

    input[type=radio] {
        position: absolute;
        visibility: hidden;
        display: none;
    }

    label {
        color: #404040;
        display: inline-block;
        cursor: pointer;
        font-weight: bold;
        padding: 5px 20px;
        text-align: center;
    }

    input[type=radio]:checked + label{
        color: #efefef;
        background: #675f6b;
    }

    label + input[type=radio] + label {
        border-left: solid 3px #332f35;
    }
    .radio-group {
        border: solid 2px #675f6b;
        display: inline-block;
        overflow: hidden;
        margin-left:15%;
    }

</style>


    <br/><br/><h1>Forgot your password</h1>
    <p style="text-align: center">You have two options, you can reset your password or we can send the password reminder that you provided while you were registering your account. <br/>Select the route you could like to go down.</p>

    <div class="form-container">
        <form method="post" action="forgotPasswordOptions.php">
            <div class="radio-group">
                <input type="radio" id="option-one" name="selector" value="option-one"><label for="option-one">Password Reset</label><input type="radio" id="option-two" name="selector" value="option-two"><label for="option-two">Password reminder</label>
            </div><br><br>
            <div class="submit-wrap">
                <input type="submit" value="Continue" class="button" name="updatePassword">
            </div>
        </form>
    </div>

<?php
echo makePageFooter();
?>