
<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<h1> Maintain roles</h1> ";

    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
             <table id=\"customers\">
                  <tr>
                    <th>Username</th>
                    <th>User type</th>
                    <th>Delete</th>
                    <th>Suspend</th>
                  </tr>
                  <tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 2</td>
                    <td>Client</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 3</td>
                    <td>Freelancer</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 4</td>
                    <td>Admin</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 5</td>
                    <td>Client</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 6</td>
                    <td>Freelancer</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                    <td>Username 7</td>
                    <td>Freelancer</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  <tr>
                    <td>Username 8</td>
                    <td>Client</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 9</td>
                    <td>Client</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                  <tr>
                    <td>Username 10</td>
                    <td>Admin</td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Delete\" class=\"button\"></td>
                    <td><input style='margin: 0'; type=\"submit\" value=\"Suspend\" class=\"button\"></td>
                  </tr>
                </table>
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
