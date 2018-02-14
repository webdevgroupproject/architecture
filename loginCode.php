<?php
//Anthony Wilkinson built using these tutorials for guidance
//https://www.youtube.com/watch?v=uVdu4war_Uo
//http://hazardedit.com/
require_once('scripts/functions.php');
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint 2fa code");
echo makeHeader();
echo startSession();
?>
<style>
    .barcode {
        width:10%;
        margin-left: 45%;
    }
    #login_status {
        text-align: center;
        margin-top:1%;
    }

    #google_code{
        margin-left:45%;
    }
</style>
<?php


require_once 'PHPGangsta/GoogleAuthenticator.php';
echo "<h1> 2 factor authentication </h1>";
$websiteTitle = 'Blueprint';

$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();

echo "<p style='text-align: center'>Using google authenticator mobile application, scan the barcode and enter the generated code into the input field below.</p>";
$qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
echo '<br /><img class="barcode" src="'.$qrCodeUrl.'" />';

$myCode = $ga->getCode($secret);

$_SESSION['secret'] = $secret;


//third parameter of verifyCode is a multiplicator for 30 seconds clock tolerance
$result = $ga->verifyCode($secret, $myCode, 1);

echo "<div id=\"login_status\">Enter your google authenticator code</div><br>
    <div id=\"login_form\">
 <input type=\"text\" id=\"google_code\" />
        <input type=\"submit\" id=\"submit_code\" />
    </div>";
?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('input#submit_code').on('click', function () {
            var google_code = $('input#google_code').val();
            if (google_code.length > 4) {
                $.post('ajax/login.php', {google_code: google_code}, function (result) {
                    if (result == 1) {
                        $(location).attr("href", "index.php");
                    } else {
                        $('div#login_status').text('Login failed');
                    }
                });
            }
        });
    </script>
<?php
echo "</body>
</html>";

echo makePageFooter();