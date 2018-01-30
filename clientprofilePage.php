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
      <a href="notifications.php" class="button">Notifications</a>
      <a href= "editProfile.php" class="button">Edit Profile</a>
      <a href= "messaging.php" class="button">Messages</a>
    </div>
  </div>
</div>

<h3 id="activejobtitle">My Active Job Posts</h3>

<p id="rcorners1">Newcastle Public House Build</p>
<p id="rcorners2">EDIT DELETE</p>

<p id="rcorners1">Landscape Request</p>
<p id="rcorners2">EDIT DELETE</p>

<br>
<br>
<br>

<?php
echo makePageFooter();
?>
