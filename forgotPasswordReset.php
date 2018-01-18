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

if (isset($_SESSION['email'])) {
    echo "
        <html>
        <body>
        <br><br><br><h1>Create a new password</h1>
        <form method=\"post\" action=\"forgotPasswordReset.php\">
            <label for='password'>Password<input type=\"password\" name=\"password\"> </label> <br>
            <label for='confirmPassword'>Confirm password<input type=\"password\" name=\"confirmPassword\"></label> <br>
            <input type=\"submit\" value=\"update\" name=\"updatePassword\" class='button'>
        </form>
        </body>
        </html>
    ";
} else {
    echo "You can't get access to this page.";
}

if (isset($_POST['updatePassword'])) {

    $email = $_SESSION['email'];

    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $confirmPassword = isset($_REQUEST['confirmPassword']) ? $_REQUEST['confirmPassword'] : '';

    $errors = array();

    if (empty($password)) {
        $errors[] = "<p>You need to enter a password</p>";
    } else if (empty($password)) {
        $errors[] = "<p>You need to confirm your password</p>";
    } else if ($password !== $confirmPassword) {
        $errors[] = "<p>You need to confirm your password</p>";
    } else if(strlen($password)<6) {
        $errors[] = "<p>Your password needs to more than 6 characters long</p>";
    }

    if (! empty($errors)){
        foreach ($errors as $currentError){
            echo $currentError;
            exit;
        }
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $dbConn->query("UPDATE bp_user SET password= '$password_hash', token = ''   where email = '$email' ");
        echo "<p>Password updated</p>";
        session_destroy();
    }
}

echo makePageFooter();
?>