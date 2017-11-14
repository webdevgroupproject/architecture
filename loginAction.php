<?php
ini_set("session.save_path", "/Applications/MAMP/sessionData");
session_start();

require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Login process");
echo makeHeader();

$conn = mysqli_connect('localhost', 'root', 'root', 'blueprint');
if (mysqli_connect_errno()) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

$username = filter_has_var(INPUT_GET, 'email') ? $_GET['email'] : null;
$pwd = filter_has_var(INPUT_GET, 'password') ? $_GET['password'] : null;

$errors = array();

if (empty($username)) {
    $errors[] = "<p>Sorry you have not entered a username</p>";
}

if(empty($pwd)) {
    $errors[] = "<p>Sorry you have not entered a password</p>";
}

if (!empty($errors)){
    foreach ($errors as $currentError){
        echo $currentError;
    }
}
else {

    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $pwd = filter_var($pwd, FILTER_SANITIZE_SPECIAL_CHARS);

    trim($username);
    trim($pwd);

    $sql = "SELECT  password from bp_user where username = ? or email = ?" ;

    $stmt = mysqli_prepare ($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $username, $username);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $pwd);

    if(mysqli_stmt_fetch($stmt)) {

        if ($_SESSION['email'] = $username && $_SESSION['logged-in'] = true) {
            header('location: /events.php');
        }
        else {
            echo '<p>login credentials were incorrect please try again </p>';
        }
    }
    else {
        echo "<p>login credentials were incorrect please try again </p>";
    }


    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    echo makePageFooter();
}
?>