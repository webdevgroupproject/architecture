<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<style>

    body {

    }

    input[type=radio] {
        position: absolute;
        visibility: hidden;
        display: none;
    }

    label {
        color: #404040;
        display: inline-block;
        cursor: pointer;
        padding: 5px 20px;
        width: 50%;
        box-sizing: border-box;
        float: left;

    }

    input[type=radio]:checked + label{
        color: #efefef;
        background: #675f6b;
        font-weight: bold;
    }

    label + input[type=radio] + label {
        border-left: solid 3px #332f35;
    }

    .radio-group {
        border: solid 2px #675f6b;
        display: inline-block;
        overflow: hidden;
        margin-left:15%;
        width: 100%;
        float: right;
        margin-top: 15px;
        margin-bottom: 15px;
    }

</style>

<br/><br/><h1>Create your account</h1>
<div class="form-container">
    <form method="get" action="Create-Account-Page-2-Client.php">
        <label>Username: </label>
        <input type="text" name="username">
        <label>Email: </label>
        <input type="text" name="Email">
        <label>Password: </label>
        <input type="password" name="password">
        <label>Confirm Password: </label>
        <input type="password" name="confirmpassword">
        <label>Password Hint: </label>
        <input type="text" name="passwordhint">
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
    </form>
</div>
<br>
<p style="text-align: center">Already have an account? <a href="#">Click here</a></p>
<br>
<br>
<br>

<?php
echo makePageFooter();
?>