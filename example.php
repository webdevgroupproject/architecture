<?php
//define the number of rows to return per page
define("ROW_PER_PAGE", 6);
?>
<script type="text/javascript">
    function confirm_delete() {
        return confirm('are you sure you would like to delete?');
    }
</script>
<?php
require_once('scripts/functions.php');
echo startSession();
require_once('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$eventSQL = 'SELECT userId, username, userRole FROM bp_user order by username';

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
          <p>If you require any assistance , contact us on admin@blueprint.com</p>
          
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

    }
}

if (isset($_SESSION['username']) && ($userType == "admin")) {
    echo "<h1>Maintain user roles</h1>";
// Pagination Code starts
    $per_page_html = '';
    $page = 1;
    $start=0;
    if(!empty($_POST["page"])) {
        $page = $_POST["page"];
        $start=($page-1) * ROW_PER_PAGE;
    }
    $limit=" limit " . $start . "," . ROW_PER_PAGE;
    $pagination_statement = $dbConn->prepare($eventSQL);
    $pagination_statement->execute();

    $row_count = $pagination_statement->rowCount();
//if there are results returned
    if(!empty($row_count)){
        //add html to display the pagination links in a div to a variable
        $per_page_html .= "<div class='pag-links'>";
        if ($row_count > ROW_PER_PAGE){
            $per_page_html .= "<span style='margin-right: 10px;'>Pg</span>";
        }
        //divide the number of rows by the number of rows per page to get the page count
        $page_count=ceil($row_count/ROW_PER_PAGE);
        //if the page count is bigger than 1 show the pagination links
        if($page_count>1) {
            for($i=1;$i<=$page_count;$i++){
                if($i==$page){
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button pag-button-current" />';
                } else {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="pag-button" />';
                }
            }
        }
        $per_page_html .= "</div>";
    }

    $query = $eventSQL . $limit;
    $pdo_statement = $dbConn->prepare($query);
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();


    //display results
    echo "<div class='result-set'>
                <div class=\"images-container\">";
                    if (!empty($result)) {
                        echo "
                        <div class=\"images-container\">
                            <div class=\"imageHalfContain\">
                                <table id=\"customers\">
                                    <tr>
                                        <th>Username</th>
                                        <th>User role</th>
                                        <th>Delete</th>
                                        <th>Suspend</th>
                                    </tr>";
                                    foreach ($result as $row) {
                                        $userID = $row['userId'];
                                        echo "
                                            <tr>
                                                <td>$row[username]</td>
                                                <td>$row[userRole]</td>
                                                <td><a class='button' id='modalButton'  onclick=\"return confirm_delete()\" style='margin: 0;' href='deleteUser.php?userId=$userID'>Delete user</a></td>
                                                <td><a class='button' style='margin: 0;'  href='suspendUserReason.php?userId=$userID' >Suspend user</a></td>
                                            </tr>";
                                    }

                                echo"</table> </div>";
                    }

                                    echo "
                                    <div class=\"imageHalfContain\">
                                        <h2 style='text-align: center; margin: 0;'>Create a new admin account</h2>
                                            <div class=\"form - container\">
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
                                                    <div class=\"submit - wrap\">
                                                        <input type=\"submit\" value=\"Create\" class=\"button\" name='AdminUser'>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>";

                        echo"</div>
                        <form name='frmSearch' action='' method='post' class=\"pag-form\">
                                $per_page_html
                        </form>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}


echo makePageFooter();
?>
