<?php
require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
      <div class="home-banner">
        <div class="banner-text">
          <h2>Welcome to the uk's leading architecture community</h2>
          <p class="tagline" style="text-align: left;">Post your projects and search for freelancers or accept jobs as a freelancer.</p>
          <a href="#" class="button">Get started</a>
        </div>
        <img src="images/blueprint-paper-banner.jpeg" alt="image of a blue print">
      </div>
      <div class="how-it-works-section">
        <div class="images-container">
          <h1>How it works</h1>
          <div class="imageFourContain">
            <img src="images/test-image.png" alt="test image">
          </div>
          <div class="imageFourContain">
            <img src="images/test-image.png" alt="test image">
          </div>
          <div class="imageFourContain">
            <img src="images/test-image.png" alt="test image">
          </div>
          <div class="imageFourContain">
            <img src="images/test-image.png" alt="test image">
          </div>
        </div>
      </div>
      <div class="community-events-section">
        <div class="images-container">
          <h1>Community events</h1>
          <p class="tagline">Sign up for one of our many events and get involved with the community.</p>

            <div class="imageThirdContain">
              <a href="#">
              <div class="image-with-text">
                <img src="images/event-img-1.jpeg" alt="image of a 3d model house">
                <div class="attendance-info-banner">
                  <span class="number-attending">9 attending</span>
                  <span class="spaces-left">11 spaces left</span>
                </div>
                <div class="image-text">
                  3D modeling seminar
                  <p>14th March 2018 | Newcastle University | 10:30 AM</p>
                </div>
              </div>
              </a>
            </div>


            <div class="imageThirdContain">
              <a href="#">
              <div class="image-with-text">
                <img src="images/event-img-2.jpeg" alt="image of a blueprint">
                <div class="attendance-info-banner">
                  <span class="number-attending">30 attending</span>
                  <span class="spaces-left">20 spaces left</span>
                </div>
                <div class="image-text">
                  Learn to Blueprint
                  <p>17th March 2018 | Sage Newcastle | 07:00 PM</p>
                </div>
              </div>
              </a>
            </div>

            <div class="imageThirdContain">
              <a href="#">
              <div class="image-with-text">
                <img src="images/event-img-3.jpeg" alt="building a h">
                <div class="attendance-info-banner">
                  <span class="number-attending">79 attending</span>
                  <span class="spaces-left">21 spaces left</span>
                </div>
                <div class="image-text">
                  Charity home build
                  <p>10th April 2018 | Newcastle Civic Center | 09:00 AM</p>
                </div>
              </div>
              </a>
            </div>
        </div>
        <a href="events.html" style="margin-left: 2.5%;">See all events</a>
      </div>
<?php
echo makePageFooter();
?>