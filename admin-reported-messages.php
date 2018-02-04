<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin reported messages and posts");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbConn = databaseConn::getConnection();


if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1>Reported messages</h1><br/> ";

    echo "<div class='images-container' style='width: 90%; margin-left:5%';>
      <table id=\"customers\">
                  <tr>
                    <th>Reported user</th>
                    <th style=\"width:700px; max-width: 700px;\">Message posted</th>
                    <th style=\"width:100px; max-width: 100px;\">View</th>
                    <th style=\"width:100px; max-width: 100px;\">Remove</th>
                    <th style=\"width:100px; max-width: 100px;\">Ignore</th>
                  </tr>";

    $query = "SELECT username, message FROM bp_message inner join bp_user on bp_message.userID = bp_user.userId where reported = 1 ";
    $result = $dbConn->prepare($query);
    $result->execute();
    $recordSet = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($recordSet as $row) {
        echo "<tr>
                <td>$row[username]</td>
                <td>$row[message]</td>
                <td><a class='button' id='modalButton'  onclick=\"return confirm_delete()\" style='margin: 0;' href=''>View message</a></td>
                <td><a class='button' style='margin: 0;'  href='' >Suspend user</a></td>
                <td><a class='button' style='margin: 0;'  href='' >Ignore report</a></td>
              </tr>";
    }

    echo" </table>
    </div>";


} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>

