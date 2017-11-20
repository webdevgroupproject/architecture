<?php
require_once ('scripts/functions.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
?>
    <div class="home-banner">
        <img src="images/community-banner.jpeg" alt="image of a blue print">
    </div>
    <div class="get-involved-section">
        <h1>Get involved</h1>
        <div class="images-container">

            <div class="imageHalfContain">
                <a href="events.php">
                    <div class="image-with-text">
                        <div class="blueTitle"><h1>Community events</h1></div>
                        <img src="images/community-events.jpeg" alt="building a h">
                        <div class="image-text">
                            Charity home build
                            <p>10th April 2018 | Newcastle Civic Center | 09:00 AM</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="imageHalfContain">
                <a href="forum.php">
                    <div class="image-with-text">
                        <div class="blueTitle"><h1>Discussion board</h1></div>
                        <img src="images/forum-image.jpeg" alt="image of a blueprint">
                        <div class="image-text">
                            Learn to Blueprint
                            <p>17th March 2018 | Sage Newcastle | 07:00 PM</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php
echo makePageFooter();
?>