<?php

ini_set("session.save_path", "/Applications/MAMP/sessionData");
session_start();
?>
<?php
require_once('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Admin");
echo makeHeader();


include 'classes/databaseConn.php';

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    if ($username == "rossbrown") {


        echo "<h1> Admin page </h1><br/><br/>";

        echo "<div class=\"thread\" style='background-color: #CFCFCF'>
            <div class=\"images-container\">
              <div class=\"imageThirdContain\">
                <p style='text-align: center'><b>Total website users <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
                <p style='text-align: center' ><b>Total active jobs <br/> 40</b></p>
              </div>
              <div class=\"imageThirdContain\">
                <p style='text-align: center'><b>Total premium users <br/> 40</b></p>
              </div>
            </div>
        </div>";

        echo "<div class=\"images-container\">

            <div class=\"imageHalfContain\">
            <h2>Heading</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

</p> <br/>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum velit et enim sagittis, et vestibulum purus varius. In ornare sapien a dui laoreet mollis. Etiam id suscipit elit.

</p>
            </div>

            <div class=\"imageHalfContain\">
                <h2>Daily statistics</h2>
                <div class=\"images-container\" style='border-style: solid;'>
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
                <div class=\"images-container\" style='border-style: solid;'>
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
                <div class=\"images-container\" style='border-style: solid;'>
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

