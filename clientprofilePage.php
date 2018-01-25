<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
<div class="profilewrapper">
  <img class='profilebg' src="images/newcastlebackground.jpg">
  <div class="profilebgcontent">
    <img id="profilepicture" src="images/profilepicture.jpg" />
    <h2 class="profilepagename">Jodi Clark</h2>
    <p class="profilepagelocation">Newcastle upon Tyne</p>

    <div class="form-container-profile">
      <input type="submit" value="Notifications" class="button">
      <input type="submit" value="Edit Profile" class="button">
      <input type="submit" value="Messages" class="button">
    </div>
  </div>
</div>

<h3 id="activejobtitle">My Active Job Posts</h3>

<?php
echo makePageFooter();
?>
