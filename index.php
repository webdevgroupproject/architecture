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
          <p class="tagline" style="text-align: left;">Post your projects and search for freelancers or accept jobs as a freelancer.</p>
          <a href="#" class="button">Get started</a>
        </div>
        <img id="banner"src="images/banner.jpg" alt="image of a blue print">
      </div>
      <div id="howitworks" class="how-it-works-section">
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
            <?php
            $dbConn = databaseConn::getConnection();

            $eventSQL = 'select *
             from bp_events
             order by eventDate
             LIMIT 3';

            $stmt = $dbConn->query($eventSQL);
            while ( $event = $stmt->fetchObject()) {


                echo "<div class=\"imageThirdContain\">
            <a href=\"eventPage.php?eventid=" . $event->eventId . "\">
            <div class=\"image-with-text\">
              <img src=\"images/event-img-1.jpeg\" alt=\"image of a 3d model house\">
              <div class=\"attendance-info-banner\">
                <span class=\"number-attending\">9 attending</span>
                <span class=\"spaces-left\">11 spaces left</span>
              </div>
              <div class=\"image-text\">" . $event->eventName . "<p>" . $event->eventDate . " | " . $event->eventPlace . " | " . $event->eventTime . "</p>
              </div>
            </div>
            </a>
          </div>";
            }

            ?>
        </div>
        <a href="events.php" style="margin-left: 2.5%;">See all events</a>
      </div>
<?php
echo makePageFooter();
?>
