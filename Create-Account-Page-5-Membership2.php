<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<br/><br/><h1>Payment Details</h1>
<div class="form-container">
    <form method="get" action="clientprofilePage.php">
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
