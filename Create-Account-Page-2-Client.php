<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<br/><br/><h1>Personal Details</h1>
<div class="form-container">
    <form method="get" action="Create-Account-Page-3-Client.php">
        <label>Forename: </label>
        <input type="text" name="username">
        <label>Surname: </label>
        <input type="text" name="Email">
        <label>Location: </label>
        <input type="password" name="password">
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
