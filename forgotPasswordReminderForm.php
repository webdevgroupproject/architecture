<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('scripts/functions.php');
require_once('classes/databaseConn.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint password reminder");
echo makeHeader();


$dbConn = databaseConn::getConnection();

if (isset($_POST['forgotPassword'])) {

    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

    $sql = $dbConn->prepare("SELECT userId from bp_user where email = '$email'");
    $sql->execute();

    $results = $sql->rowCount();

    if ($results > 0) {
        $reminderMessage = "";
        $_SESSION['email'] = $email;

        $sql2 = "select passwordHint
                        from bp_user
                        WHERE email = '$email'";
        $stmt = $dbConn->query($sql2);
        $stmt->execute();
        $passwordHint = $stmt->fetchColumn();

        $to = $email;

        $subject = 'Password hint request';

        $message = "
            <html>
            <head>
              <title>Password hint</title>
            </head>
            <body>
              <p>Dear $email, <br/> you recently submitted a request for your password reminder which you provided when registering your account.</p>
              <p>Your password hint is -  <b>$passwordHint.</b></p>
              <p>Kind regards, Blueprint</p>
            </body>
            </html>
            ";

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = 'To: $email';
        $headers[] = 'From: doNotReply@blueprint.com';

        // Mail it
        mail($to, $subject, $message, implode("\r\n", $headers));


        echo "
        <h1>Check your emails</h1>
        <p style='text-align: center'>Please check your emails, we have sent you a message which includes your password hint which you entered whilst registering.</p>";
    } else {
        echo "<p>We could not match that email address</p>";
    }
} else {
    echo "<body>
    <br><br><br><h1>Enter your email address</h1>
    <form method=\"post\" action=\"forgotPasswordReminderForm.php\">
        <label for=\"email\">Email address:
            <input type=\"text\" name=\"email\">
        </label>
        
        <input type=\"submit\" value=\"send email\" name=\"forgotPassword\" class=\"button\">
    </form>
</body>";
}

echo makePageFooter();
?>
