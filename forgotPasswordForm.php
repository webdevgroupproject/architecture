<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('scripts/functions.php');
require_once('classes/databaseConn.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint forgot password");
echo makeHeader();


$dbConn = databaseConn::getConnection();

if (isset($_POST['forgotPassword'])) {

    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

    $sql = $dbConn->prepare("SELECT userId from bp_user where email = '$email'");
    $sql->execute();

    $results = $sql->rowCount();

    if ($results > 0) {
        $str = "0123456789anthwidlhgyfuridhfyetsgafwrteysdmvmvbmxkdlghoyot";
        $str = str_shuffle($str);
        $str = substr($str, 0, 10);

        $_SESSION['email'] = $email;

        $message = "To reset your password, please click on the following link: http://unn-w14011103.newnumyspace.co.uk/blueprint/forgotPasswordReset.php?token='$str'&email='$email'";
        mail($email, "Reset password", $message, "From: doNotReply@blueprint.com");

        $dbConn->query("UPDATE bp_user SET token='$str' where email='$email'");

        echo "
        <h1>Check your emails</h1>
        <p style='text-align: center'>Please check your emails for a link to reset your password, if you can't find the email, check your spam or junk email folders</p>";
    } else {
        echo "
            <div class=\"ErrorMessages\">
            <p><b>The following errors occurred:</b></p>
            <li>We couldn't match the email address which you have provided. </li>
            </div>";
    }
} else {
    echo "<body>
    <br><br><br><h1>Enter your email address</h1>
    <form method=\"post\" action=\"forgotPasswordForm.php\">
        <label for=\"email\">Email address:
            <input type=\"text\" name=\"email\">
        </label>
        <input type=\"submit\" value=\"send email\" name=\"forgotPassword\" class=\"button\">
    </form>
</body>";
}

echo makePageFooter();
?>
