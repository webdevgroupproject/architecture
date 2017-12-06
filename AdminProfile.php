<?php

//ini_set("session.save_path", "/xampp1/sessionData");
//session_start();
?>
<?php
require_once('scripts/functions.php');
echo startSession();
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();


include 'classes/databaseConn.php';

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $userRole = $_SESSION['userRole'];


    if ($username == "rossbrown") {


        echo "<h1> Admin profile page </h1><br/><br/><br/>";
        echo $userRole;

        echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
              <img src='images/icon-template.png' style='width: 100px; position: relative; bottom:90px; left: 210px;'> <br/><br/>
                <p style='text-align: center'><b>Total website users <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/icon-template.png' style='width: 100px; position: relative; bottom:90px; left: 210px;'> <br/><br/>
                <p style='text-align: center' ><b>Total active jobs <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
              <img src='images/icon-template.png' style='width: 100px; position: relative; bottom:90px; left: 210px;'> <br/><br/>
                <p style='text-align: center'><b>Total premium users <br/> 40</b></p>
              </div>
            </div>
        </div>";

        echo "<div class=\"images-container\">

            <div class=\"imageHalfContain\">
            <h2>Heading</h2>
               <p style='text-align:justify'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

</p> <br/>

<p style='text-align:justify'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

</p>

<input type=\"submit\" value=\"Client statistics\" class=\"button\">
<input type=\"submit\" value=\"Freelancer statistics\" class=\"button\">
            </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics</h2>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center'>10 <br/> Today</p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center' >10 <br/> This week</p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center'>10 <br/> This month</p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New premium users</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center'>10 <br/> Today</p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center' >10 <br/> This week</p>
                  </div>
                  <div class=\"imageThirdContain\"> 
                    <p style='text-align: center'>10 <br/> This month</p>
                  </div>
                </div>
                <div class=\"statistics-container\" style='border-style: solid;'>
                    <h3 style='text-align: center'>New jobs created</h3>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center'>10 <br/> Today</p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center' >10 <br/> This week</p>
                  </div>
                  <div class=\"imageThirdContain\">
                    <p style='text-align: center'>10 <br/> This month</p>
                  </div>
                </div>
            </div>";

    } else {
        echo "<p> Sorry you don't have the permissions to use this page</p>";
    }
}


echo makePageFooter();
?>

