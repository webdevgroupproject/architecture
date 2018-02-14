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
<h1>Choose your Account Type</h1>

<div class="form-container">
    <form method="post" action="cardDetails.php">
        <div class="radio-group">
            <input type="radio" id="option-one" name="selector" value="option-one">
            <label for="option-one">Free</label>
            <input type="radio" id="option-two" name="selector" value="option-two">
            <label for="option-two" style="float:right;">Blueprint Pro</label>
        </div>
        <div class="submit-wrap">
            <input type="submit" value="Next" class="button" name="accountTypeNext" style="width: 170px;">
        </div>
    </form>
</div>

<style>

    input[type=radio] {
        position: absolute;
        visibility: hidden;
        display: none;
    }

    .radio-group {
        border: solid 2px #675f6b;
        display: inline-block;
        overflow: hidden;
        margin-left:15%;
    }

    label + input[type=radio] + label {
        border-left: none;
   }

   .radio-group label {
        width: 49%;
        color: #404040;
        display: inline-block;
        cursor: pointer;
        font-weight: bold;
        padding: 5px 20px;
        text-align: center;
   }

   .test {
     width: 50%;
     float: left;
   }

   .test label {
     float: left;
     width: 50%;
   }

   .test input {
     width: 75%;
     clear: both;
   }

</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $.validate({
    form : ".login-form"

});
</script>

</body>
</html>

<?php
echo makePageFooter();
?>
