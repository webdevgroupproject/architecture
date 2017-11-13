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
  $headerContent = <<<HEADER
  <header>
    <div class="logo-contain">
    <a href="index.php"><img src="images/logo-test.png" alt="Blueprint company logo"></a>
    </div>
    <nav class="header-nav">
        <ul>
          <li><a href="#">Join the community</a></li>
        </ul>
    </nav>
    <nav class="user-nav">
      <span class="user-conrol-links">
        <a href="#">Sign up</a> | <a href="login.php">Log in</a>
      </span>
    </nav>
  </header>
  <main>
HEADER;
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