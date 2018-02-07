<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
<h1>Success!</h1>
<div id="jobConfirmContent">
  <p>Your job has been successfully posted for others to see. You can edit and review your posting from your profile page.</p>
  <a href="profile.php" class="button">Return to your profile</a>
</div>

<?php
echo makePageFooter();
?>
