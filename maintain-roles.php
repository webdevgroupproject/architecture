<?php
ob_start();
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbConn = databaseConn::getConnection();
if (isset($_POST['AdminUser'])) {
    $forename = isset($_REQUEST["forename"]) ? $_REQUEST["forename"] : null;
    $surname = isset($_REQUEST["surname"]) ? $_REQUEST["surname"] : null;
    $emailAddress = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    $userName = isset($_REQUEST["username"]) ? $_REQUEST["username"] : null;
    $password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : null;
    $confirmPassword = isset($_REQUEST["password-confirm"]) ? $_REQUEST["password-confirm"] : null;

    $forename = filter_var($forename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $surname = filter_var($surname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $emailAddress = filter_var($emailAddress, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $userName = filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


    $forename = filter_var($forename, FILTER_SANITIZE_SPECIAL_CHARS);
    $surname = filter_var($surname, FILTER_SANITIZE_SPECIAL_CHARS);
    $emailAddress = filter_var($emailAddress, FILTER_SANITIZE_SPECIAL_CHARS);
    $userName = filter_var($userName, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_SPECIAL_CHARS);

    trim($forename);
    trim($surname);
    trim($userName);
    trim($emailAddress);
    trim($password);
    trim($confirmPassword);

    $errors = array();

    if (empty($forename)) {
        $errors[] = "You have not entered a forename";
    }

    if (empty($surname)) {
        $errors[] = "You  have not entered a surname";
    }

    if (empty($emailAddress)) {
        $errors[] = "You have not entered a email address";
    }

    if (empty($userName)) {
        $errors[] = "You have not entered a firstname";
    }

    if (empty($password)) {
        $errors[] = "You have not entered a password";
    }

    if (empty($confirmPassword)) {
        $errors[] = "You have not entered the confirm password";
    }
    if (strlen($forename > 100)) {
        $errors[] = "You have entered too many characters for forename .";
    }

    if (strlen($surname > 100)) {
        $errors[] = "You have entered too many characters for surname .";
    }

    if (strlen($emailAddress > 100)) {
        $errors[] = "You have entered too many characters for the email address .";
    }

    if (strlen($userName > 100)) {
        $errors[] = "You have entered too many characters for username .";
    }

    if (strlen($password > 100)) {
        $errors[] = "You have entered too many characters for password .";
    }

    if (strlen($confirmPassword > 100)) {
        $errors[] = " You have entered too many characters for confirm password .";
    }

    if ($password != $confirmPassword) {
        $errors[] = "Your passwords do not match";
    }

    $emailSQL = "SELECT email from bp_user where email = '$emailAddress'";
    $query = $dbConn->prepare($emailSQL);
    $query->execute();
    $count = $query->rowCount();

    if ($count > 0) {
        $errors[] = "The email which you have provided is already in use. Please use another email address.";
    }

    $usernNameSQL = "SELECT username from bp_user where username = '$userName'";
    $query = $dbConn->prepare($usernNameSQL);
    $query->execute();
    $count = $query->rowCount();

    if ($count > 0) {
        $errors[] = "The username you have provided is already in use. Please try another one";
    }
    if (!empty($errors)) {
        echo "<div class=\"ErrorMessages\">";
        echo "<b>The following errors occurred:</b> ";
        foreach ($errors as $currentError) {
            echo '<li>' . $currentError . '</li>';
        }
        echo "</div>";
    } else {

        $password_hash = password_hash($confirmPassword, PASSWORD_BCRYPT);
        $sql = "INSERT INTO bp_user (forename, surname, email, username, password, pro, image, overview, organisation, websiteLink, userRole, token, passwordHint, dateAdded, suspended) VALUES ('$forename', '$surname', '$emailAddress', '$userName', '$password_hash', '0', '', '', '', '', 'admin', '', '', now(), 0)";

        $query = $dbConn->prepare($sql);

        $query->execute();

        $to = $emailAddress;

        $subject = 'Admin user account created';

        $message = "
        <html>
        <head>
          <title>New admin user account</title>
        </head>
        <body>
          <p>Dear $emailAddress, <br/> we are emailing you to let you know that your new admin account has been created by admin staff at Blueprint.</p>
          <p>You can login using the following details:</p>
          <p><b>Username: $userName</b></p>
          <p><b>Email address: $emailAddress</b></p>
          <p><b>password: $password</b></p>
          <p>once you have logged into your account, change your password and check that all information that we have submitted to your account is correct using the edit profile section of the website.</p>
          <p>If you require any assitaince , contact us on admin@blueprint.com</p>
          
          <p>Kind regards, Blueprint</p>
        </body>
        </html>
        ";

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = 'To: $userEmail';
        $headers[] = 'From: doNotReply@blueprint.com';

        // Mail it
        mail($to, $subject, $message, implode("\r\n", $headers));

        header('Location: login.php');

    }
}

if (isset($_SESSION['username']) && ($userType == "admin")) {


    echo "<h1> Maintain user roles</h1> ";

    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
                <table id=\"customers\">
                  <tr>
                    <th>Username</th>
                    <th>User role</th>
                    <th>Delete</th>
                    <th>Suspend</th>
                   
                  </tr>";

    $query = "SELECT userId, username, userRole FROM bp_user order by username";
    $result = $dbConn->prepare($query);
    $result->execute();
    $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($recordSet as $row) {
        $userID = $row['userId'];
        echo "<tr>
                        <td>$row[username]</td>
                        <td>$row[userRole]</td>
                        <td><a class='button' id='modalButton'  onclick=\"return confirm_delete()\" style='margin: 0;' href='deleteUser.php?userId=$userID'>Delete user</a></td>
                        <td><a class='button' style='margin: 0;'  href='suspendUserReason.php?userId=$userID' >Suspend user</a></td>
                      </tr>";
    }

    echo" </table>
                </div>

            <div class=\"imageHalfContain\">
                <h2 style='text-align: center; margin: 0;'>Create a new admin account</h2>
                <div class=\"form-container\">
                    <form method=\"POST\" action=\"maintain-roles.php\" id='test' >
                        <label>Forename: </label>
                        <input type=\"text\" name=\"forename\">
                        <label>Surname: </label>
                        <input type=\"text\" name=\"surname\">
                        <label>Email address: </label>
                        <input type=\"text\" name=\"email\">
                        <label>Username: </label>
                        <input type=\"text\" name=\"username\">
                        <label>Password: </label>
                        <input type=\"password\" name=\"password\">
                        <label>Confirm password: </label>
                        <input type=\"password\" name=\"password-confirm\">
                        <div class=\"submit-wrap\">
                            <input type=\"submit\" value=\"Create\" class=\"button\" name='AdminUser'>
                        </div>
                    </form>
                </div>
            </div>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>

