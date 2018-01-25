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

//    echo "
//            <div id=\"myModal\" class=\"modal\">
//
//              <!-- Modal content -->
//              <div class=\"modal-content\">
//                <div class=\"modal-header\">
//                  <span class=\"close\">&times;</span>
//                  <h1>Delete user</h1>
//                </div>
//                <div class=\"modal-body\">
//                  <p>Are you sure you would like to delete this user? Once you confirm, this action can not be undone</p>
//                </div>
//                <div class='modal-footer'>
//                    <a href='deleteU.php?userId=$userID' class='button'>Confirm</a>&nbsp &nbsp &nbsp<a href='#' class='cancel'>Cancel</a>
//                </div>
//              </div>
//
//            </div>";

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
                    <form method=\"get\" action=\"#\" id='test'>
                        <label>Forename: </label>
                        <input type=\"text\" name=\"forename\">
                        <label>Surname: </label>
                        <input type=\"text\" name=\"surname\">
                        <label>Email address: </label>
                        <input type=\"email\" name=\"email\">
                        <label>Password: </label>
                        <input type=\"password\" name=\"password\">
                        <label>Confirm password: </label>
                        <input type=\"password\" name=\"password-confirm\">
                        <div class=\"submit-wrap\">
                            <input type=\"submit\" value=\"Create\" class=\"button\">
                        </div>
                    </form>
                </div>
            </div>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();

?>
<!---->
<!--<script> //Get the modal-->
<!--    var modal = document.getElementById('myModal');-->
<!---->
<!--    // Get the button that opens the modal-->
<!--    var btn = document.getElementById("modalButton");-->
<!---->
<!--    // Get the <span> element that closes the modal-->
<!--    var close = document.getElementsByClassName("close")[0];-->
<!--    var cancel = document.getElementsByClassName("cancel")[0];-->
<!---->
<!--    // When the user clicks the button, open the modal-->
<!--    btn.onclick = function() {-->
<!--        modal.style.display = "block";-->
<!--    };-->
<!---->
<!--    // When the user clicks on <span> (x), close the modal-->
<!--    close.onclick = function() {-->
<!--        modal.style.display = "none";-->
<!--    };-->
<!--    cancel.onclick = function() {-->
<!--        modal.style.display = "none";-->
<!--    };-->
<!---->
<!--    // When the user clicks anywhere outside of the modal, close it-->
<!--    window.onclick = function(event) {-->
<!--        if (event.target == modal) {-->
<!--            modal.style.display = "none";-->
<!--        }-->
<!--    }-->
<!--</script>-->
