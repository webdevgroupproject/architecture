<?php
ini_set("session.save_path", "/Applications/MAMP/sessionData");
session_start();

require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Login process");
echo makeHeader();


//connect to the database
$conn = mysqli_connect('localhost', 'root', 'root', 'blueprint');
if (mysqli_connect_errno()) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

//Request username and password from the request stream - the email gets either the  username or email from the request stream
$username = filter_has_var(INPUT_GET, 'email') ? $_GET['email'] : null;
$pwd = filter_has_var(INPUT_GET, 'password') ? $_GET['password'] : null;

//Create a new errors array which will hold any errors from the login
$errors = array();

//Check if username has been entered
if (empty($username)) {
    $errors[] = "<p>Sorry you have not entered a username</p>";
}

//Check if password has been entered
if(empty($pwd)) {
    $errors[] = "<p>Sorry you have not entered a password</p>";
}

if (!empty($errors)){
    //display each error
    foreach ($errors as $currentError){
        //echo the current error / current errors within the array
        echo $currentError;
    }
}
else {

    //Sanitize input by stripping tags
    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    //Sanitising any special characters
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $pwd = filter_var($pwd, FILTER_SANITIZE_SPECIAL_CHARS);

    //Trim the white space from using space bar  (if used)
    trim($username);
    trim($pwd);

    //create a sql statement - ? is used for prepared statements
    $sql = "SELECT  password from bp_user where username = ? or email = ?" ;

    //prepare the statement
    $stmt = mysqli_prepare ($conn, $sql);

    /* Bind the $username entered by the user to the prepared statement.
    Note the “s” part indicates the data type used – in this case a string */

    mysqli_stmt_bind_param($stmt, "ss", $username, $username);

    //Execute the query
    mysqli_stmt_execute($stmt);

    /* Get the password hash from the query results for the given
    username and store it in the variable indicated */
    mysqli_stmt_bind_result($stmt, $pwd);

    /* Check if a record was returned by the query. If yes,
    then there was a username matching what was entered in the
    logon form and we can now test to see if the password entered
    in the logon form is the same as the stored (correct) one in the database. */

    if(mysqli_stmt_fetch($stmt)) {

        //Get the password from the request and the hash from the database
        if ($_SESSION['email'] = $username && $_SESSION['logged-in'] = true) {

            header('location: profile.php');
            echo "login completed";

        }
        else {
            echo '<p>login credentials were incorrect please try again </p>';
        }
    }
    else {
        echo "<p>login credentials were incorrect please try again </p>";
    }


    mysqli_stmt_close($stmt);

    //Close connection to database
    mysqli_close($conn);

    echo makePageFooter();
}
?>