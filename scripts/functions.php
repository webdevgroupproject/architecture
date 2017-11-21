<?php
//function to set up the html and the start of the page
function makePageStart($metaName, $metaContent, $pageTitle) {
	$pageStartContent = <<<PAGESTART
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="$metaName" content="$metaContent">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <title>$pageTitle</title>
  </head>
  <body>
  <div class="wrapper">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
};

function makeHeader(){
  $headerContent =
  "<header>
    <div class=\"logo-contain\">
    <a href=\"index.php\"><img src=\"images/logo-test.png\" alt=\"Blueprint company logo\"></a>
    </div>
    <div class=\"menu-wrap\">
        <nav class=\"header-nav\">
            <ul class=\"clearfix\">
              <li><a href=\"community.php\">Join the community<span class=\"arrow\"> &#9660;</span></a>
                <ul class=\"dropdown\">
                    <li><a href=\"events.php\">Events</a></li>
                    <li><a href=\"Forum.php\">Discussion board</a></li>
                 </ul>
              </li>
            </ul>
        </nav>";
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $headerContent .= "<nav class=\"user-nav\">
          <span class=\"user-conrol-links\">
            Welcome $username | <a href=\"logout.php\">Log out</a>
          </span>
        </nav>";
        } else {
            $headerContent .= "<nav class=\"user-nav\">
          <span class=\"user-conrol-links\">
            <a href=\"#\">Sign up</a> | <a href=\"login.php\">Log in</a>
          </span>
        </nav>";
        }


    $headerContent .= "</div>
    
  </header>
  <main>";

    $headerContent .="\n";
    return $headerContent;
};

function makePageFooter(){
    $makePageFooter = <<<FOOTER
    </main>
		<footer>
				<h1>The footer</h1>
		</footer>
  </div><!--end wrapper -->
</body>
</html>
FOOTER;
    $makePageFooter .="\n";
    return $makePageFooter;
};


