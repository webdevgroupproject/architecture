<script type="text/javascript">
    function confirm_delete() {
        return confirm('are you sure you would like to delete?');
    }
</script>
<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();

$dbConn = databaseConn::getConnection();
$userType = checkUserType();
$username = $_SESSION['username'];

if (isset($_SESSION['username']) && ($userType == "admin")) {

    $dbConn = databaseConn::getConnection();
    $userID = $_GET['userId'];
    $sql = "SELECT username FROM bp_user where userId = $userID";
    $result = $dbConn->prepare($sql);
    $result->execute();
    $userName = $result->fetchColumn();

    echo "
        <h1> Suspension Details</h1> 
        <div class=\"form-container\">
            <form method=\"post\" action=\"suspendUser.php\">
                 <p><b>Username: </b> $userName</p> <br>
                 
                 <b>Suspended until:</b> <input style=\"width: 150px;\" type=\"date\" name=\"date\"><br>
                 
                 <b>Reason for suspension:</b> <br><textarea name=\"Text1\" cols=\"76\" rows=\"8\"></textarea>

                <div class=\"submit-wrap\">
                    <input type=\"submit\" value=\"Submit\" class=\"button\" name=\"suspendScript\">
                </div>
            </form>
        </div>  
    ";

} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();

?>
