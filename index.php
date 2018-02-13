<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>

      <div class="home-banner">
        <div class="banner-text">
          <h2>Join the UK's Leading Arhcitecture Community</h2>
          <p class="tagline" style="text-align: left;">Post your projects and search for freelancers or sign up as a freelancer and take on the latest architecture jobs.</p>
          <a href="registerPage1.php" class="button">Get started</a>
        </div>
        <img id="banner"src="images/banner2.jpeg" alt="image of a blue print">
      </div>
      <div id="howitworks" class="how-it-works-section">
        <div class="images-container">
          <div class="imageFourContain">

              <img class="steps" src="images/step1.png" alt="test image">
              <h2>Create an account</h2>
              <ul>
                  <li><strong>start by creating an account.</strong> you can sign up as a freelancer or a client.</li>
                  <li><strong>Choose your package</strong> you can sign up for a standard free account or choose to go pro</li>
              </ul>

          </div>
          <div class="imageFourContain">

              <img class="steps" src="images/step2.png" alt="test image">
              <h2>Organise work</h2>

              <ul>
                  <li><strong>Post a job as a client.</strong> Once you post a job, freelancers can contact you with job offers.</li>
                  <li><strong>Offer work as a freelancer.</strong> As a freelaner you can search through all the jobs posted by clients and make an offer.</li>
              </ul>

          </div>
          <div class="imageFourContain">

              <img class="steps" src="images/step3.png" alt="test image">
              <h2>Get in contact</h2>

              <ul>
                 <li><strong>Message each other directly</strong> to arrange the details of your job.</li>
              </ul>

          </div>
          <div class="imageFourContain">
              
              <img class="steps" src="images/step4.png" alt="test image">
              <h2>Start working</h2>

              <ul>
                  <li><strong>Agree the details</strong> of the job and start the work.</li>
              </ul>

          </div>
        </div>
      </div>
      <div class="features-section">
        <div id="clientFeatures" class="width50 features">
            <h2>Blueprint for clients</h2>
            <table class="featuresTable">
                <tr>
                    <th></th>
                    <th>Standard</th>
                    <th>Pro</th>
                </tr>
                <tr>
                    <td>Join events</td>
                    <td class="yes"><i class="material-icons">done</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Start forum threads</td>
                    <td class="yes"><i class="material-icons">done</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Organise events</td>
                    <td class="no"><i class="material-icons">clear</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Add free</td>
                    <td class="no"><i class="material-icons">clear</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
            </table>
            <div style="width: 75%; margin: 0 auto;">
                <a href="registerPage1.php" class="button" style="float: left; margin-bottom: 10px;">Get started</a>
            </div>

        </div>
        <div id="freelanceFeatures" class="width50 features">
            <h2>Blueprint for freelancers</h2>
            <table class="featuresTable">
                <tr>
                    <th></th>
                    <th>Standard</th>
                    <th>Pro</th>
                </tr>
                <tr>
                    <td>Join events</td>
                    <td class="yes"><i class="material-icons">done</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Start forum threads</td>
                    <td class="yes"><i class="material-icons">done</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Organise events</td>
                    <td class="no"><i class="material-icons">clear</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
                <tr>
                    <td>Add free</td>
                    <td class="no"><i class="material-icons">clear</i></td>
                    <td class="yes"><i class="material-icons">done</i></td>
                </tr>
            </table>
            <div style="width: 75%; margin: 0 auto;">
                <a href="registerPage1.php" class="button" style="float: left; margin-bottom: 10px;">Get started</a>
            </div>
        </div>
      </div>
<?php
echo makePageFooter();
?>
