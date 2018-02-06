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

              <img src="images/test-image.png" alt="test image">
              <ul>
                  <li><strong>start by posting your job.</strong> once you post a job, freelancers can contact you with job offers.</li>
                  <li><strong>Browse a list of freelancer profiles</strong> to find the most suitable candidate for your job.</li>
                  <li><strong>Message freelancers directly</strong> to arrange the details of your job.</li>
              </ul>

          </div>
          <div class="imageFourContain">

              <img src="images/test-image.png" alt="test image">
              <ul>
                  <li><strong>start by posting your job.</strong> once you post a job, freelancers can contact you with job offers.</li>
                  <li><strong>Browse a list of freelancers</strong> to find the most suitable candidate for your job.</li>
                  <li><strong>Message freelancers directly</strong> to arrange the details of your job.</li>
              </ul>

          </div>
          <div class="imageFourContain">

              <img src="images/test-image.png" alt="test image">
              <ul>
                  <li><strong>start by posting your job.</strong> once you post a job, freelancers can contact you with job offers.</li>
                  <li><strong>Browse a list of freelancers</strong> to find the most suitable candidate for your job.</li>
                  <li><strong>Message freelancers directly</strong> to arrange the details of your job.</li>
              </ul>

          </div>
          <div class="imageFourContain">

              <img src="images/test-image.png" alt="test image">
              <ul>
                  <li><strong>start by posting your job.</strong> once you post a job, freelancers can contact you with job offers.</li>
                  <li><strong>Browse a list of freelancers</strong> to find the most suitable candidate for your job.</li>
                  <li><strong>Message freelancers directly</strong> to arrange the details of your job.</li>
              </ul>

          </div>
        </div>
      </div>
      <div class="community-events-section">

      </div>
<?php
echo makePageFooter();
?>
