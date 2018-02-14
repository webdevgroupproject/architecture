<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
<html>
  <head>
    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
          rel="stylesheet" type="text/css"/>
  </head>
<body>
<h1>You're now a Blueprint<br> Pro Member!</h1>
<p style="text-align: center; padding-bottom: 20px;">Thank you for signing up for our service. We hope you enjoy being a Pro.</p>


<div class="submit-wrap">
    <form action="profile.php" method="post">
      <input type="submit" value="Continue to your Account" class="button" name="continueAccount" style="width: 250px;">
    </form>
</div>

</body>
</html>

<?php
echo makePageFooter();
?>
