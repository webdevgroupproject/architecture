<?php
//error_reporting(E_ALL); ini_set('display_errors', 'On');
//ini_set("session.save_path", "/xampp1/sessionData");
//session_start();

require_once('scripts/functions.php');
require_once ('classes/databaseConn.php');
echo startSession();

$dbConn = databaseConn::getConnection();

//Request username and password from the request stream
$username = filter_has_var(INPUT_GET, 'username') ? $_GET['username'] : null;
$pwd = filter_has_var(INPUT_GET, 'password') ? $_GET['password'] : null;

$errors = array();

if (empty($username)) {
    $errors[] = "<p>Sorry you have not entered a username</p>";
}

if (strlen($username) > 60) {
    $errors[] = "Your username is too long";
}

if (empty($pwd)) {
    $errors[] = "<p>You have not entered a password</p>";
}

if (strlen($pwd) > 40) {
    $errors[] = "Your password is too long";
}

if (!empty($errors)) {
    foreach ($errors as $currentError) {
        echo $currentError;
    }
} else {

    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $pwd = filter_var($pwd, FILTER_SANITIZE_SPECIAL_CHARS);

    trim($username);
    trim($pwd);

    $sql = "SELECT password from bp_user where username = :username";

    $query = $dbConn->prepare( $sql );

    $query->execute( array( ':username'=>$username ) );

    $results = $query->fetchAll( PDO::FETCH_ASSOC );

    foreach( $results as $row ){
        if(password_verify($pwd, $row['password'])){
            $_SESSION['username'] = $username;
            $_SESSION['logged-in'] = true;
            header('Location: AdminProfile.php');
            exit();
        }
        else
        {
            echo '<p>login credentials were incorrect please try again </p>';
        }
    }


}

