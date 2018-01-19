<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();
$userType = checkUserType();
$username = $_SESSION['username'];

if (isset($_SESSION['username']) && ($userType == "admin")) {

    echo "<br><h1> Freelancer statistics</h1><br/> ";
    echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
                <img src='images/userIcon.png' style='width: 100px; margin-left:38%;'> <br><br><br><br><br><br><br>
                <p style='text-align: center'><b>Total freelancer users <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/jobIcon.png' style='width: 100px; margin-left:38%;'> <br><br><br><br><br><br><br>
                <p style='text-align: center' ><b>Total freelancer jobs <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/premium.png' style='width: 100px; margin-left:38%;'> <br><br><br><br><br><br><br>
                <p style='text-align: center'><b>Total premium freelancer users <br/> 40</b></p>
              </div>
            </div>
        </div>";
    echo "<div class=\"images-container\">
            <div class=\"imageHalfContain\">
            <h2>List of latest accepted jobs </h2>
               <table id=\"customers\">
                  <tr>
                    <th>Job title</th>
                    <th>Job description</th>
                   
                  </tr>
                  <tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr>
                  <tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr><tr>
                    <td>Username 1</td>
                    <td>Freelancer</td>
                  </tr>
                </table>
            </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>10 <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New premium users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>10 <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\"> 
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New jobs accepted</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> Today</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;' ><b>10 <br/> This week</b></p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center; font-size: 19px;'><b>10 <br/> This month</b></p>
                  </div>
                </div>
            </div>";
} else {
    echo "<p>Sorry you can't access this page</p>";
}

echo makePageFooter();
?>

