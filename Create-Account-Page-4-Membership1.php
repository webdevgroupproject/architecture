<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<br/><br/><h1>Choose your plan</h1>
<div class="form-container">
    <form method="get" action="Create-Account-Page-5-Membership2.php">
      <div class="submit-wrap">
          <br>
          <br>
          <br>
          <input type="submit" value="Next" class="button">
        </div>
    </form>
</div>

<?php
echo makePageFooter();
?>
