<?php
ob_start();
require_once('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint Login");
echo makeHeader();
$userType = checkUserType();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['loginProcess'])) {
    require_once('classes/databaseConn.php');
    echo startSession();

    $dbConn = databaseConn::getConnection();

    $username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : null;
    $pwd = isset($_REQUEST["password"]) ? $_REQUEST["password"] : null;

    $errors = array();

    if (empty($username)) {
        $errors[] = "You have not entered a username or email address";
    }

    if (empty($pwd)) {
        $errors[] = "You have not entered a password";
    }

    $CheckSuspension = "select suspended from bp_user where username = '$username' or email = '$username'";

    $queryCheck = $dbConn->prepare($CheckSuspension);

    $queryCheck->execute();

    $userSuspended = $queryCheck->fetchColumn();

    if ($userSuspended) {
        $errors [] = "You have been suspended. You can't log into your account until your suspension date is over.
                      For more information, contact suspensions@blueprint.com";
    }

    if (!empty($errors)) {
        echo"<div class=\"ErrorMessages\">";
        echo"<b>The following errors occurred:</b> ";
        foreach ($errors as $currentError) {
            echo '<li>'.$currentError.'</li>';
        }
        echo"</div>";
    } else {

        $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $pwd = filter_var($pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd = filter_var($pwd, FILTER_SANITIZE_SPECIAL_CHARS);

        trim($username);
        trim($pwd);

        $sql = "SELECT password from bp_user where username = :username or email = :email";

        $query = $dbConn->prepare($sql);

        $query->execute(array(':username' => $username, ':email' => $username));

        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {

            foreach ($results as $row) {
                if (password_verify($pwd, $row['password'])) {
                    $sql2 = "SElECT username from bp_user where email = '$username' OR username = '$username'";
                    $stmt = $dbConn->query($sql2);
                    $stmt->execute();
                    $username = $stmt->fetchColumn();

                    $_SESSION['username'] = $username;
                    $_SESSION['logged-in'] = true;
                    $sql3 = "SElECT userRole from bp_user where username = '$username'";
                    $stmt3 = $dbConn->query($sql3);
                    $stmt3->execute();
                    $userRole = $stmt3->fetchColumn();
                    if ($userRole == "admin"){
                        header('Location: loginCode.php');
                    } else {
                        header('Location: index.php');
                    }

                    exit();
                } else {
                    echo '<div class="ErrorMessages">
                            <p><b>The following errors occurred:</b></p>
                            <li>The username / email address or password you provided is incorrect. Please try again. </li>
                           </div>';
                }
            }
        } else {
            echo '<div class="ErrorMessages">
                    <p><b>The following errors occurred:</b></p>
                    <li>We couldnt match the username or email to the password which you have provided. Please try again. </li>
                   </div>';
        }
    }
} ?>

    <br/><br/><h1>Log in to your account</h1>
    <div class=\"form-container\"><br><br>
        <form method="post" action="login.php">
            <label>Email / Username: </label>
            <input type="text" name="username">
            <label>Password: </label>
            <input type="password" name="password">
            <div class="submit-wrap">
                <input type="submit" value="Login" class="button" name="loginProcess">
            </div>
        </form>
    </div><br>
    <p style="text-align: center"><a href="registerPage1.php">Sign up</a> | <a href="forgotPasswordOptions.php">Forgot password</a></p>


<?php
echo makePageFooter();
?>
