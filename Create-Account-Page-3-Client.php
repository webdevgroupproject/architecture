<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<br/><br/><h1>Organisational Details</h1>
<div class="form-container">
    <form method="get" action="Create-Account-Page-4-Membership1.php">
        <label>Organisation Name: </label>
        <input type="text" name="username">
        <label>Organisation Overview: </label>
        <textarea style="max-width: 100%; width: 100%; height: 120px; box-sizing: border-box;"></textarea>
        <label>Website Link: </label>
        <input type="password" name="password">
        <br>
        <br>
        <p style="text-align: center" class="skipthisstep"><a href="#">Skip this step </a>- You can always add this information later from inside your Account Settings Page!</p>
        <div class="submit-wrap">
          <br>
            <input type="submit" value="Next" class="button">
        </div>
    </form>
</div>
<br>

<?php
echo makePageFooter();
?>
