<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

<br/><br/><h1>You're now a blueprint Pro member!</h1>

<div class="form-containermemconfirm">
   <form method="get" action="clientprofilePage.php">
     <img id="memberconfirmtick" src="images/Tick.png" />
     <p id="memberconfirmp">Thank you for signing up for our premium service. We hope you enjoy all the benefits of being a pro</p>
     <br>
       <div class="submit-wrap">
           <input type="submit" value="Profile Page" class="button">
      </div>
   </form>


<?php
echo makePageFooter();
?>
