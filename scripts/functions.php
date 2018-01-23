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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <title>$pageTitle</title>
  </head>
  <body>
  <div class="wrapper">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
};

function makeHeader(){
    $userType = checkUserType();
  $headerContent =
  "<header>
    <div class=\"logo-contain\">
    <a href=\"index.php\"><img src=\"images/logo-test.png\" alt=\"Blueprint company logo\" id='logoImg'></a>
    </div>
    <div class=\"menu-wrap\">
        <nav class=\"header-nav\">
            <ul class=\"clearfix\">
            <li><a href=\"events.php\">Events</a></li>
                    <li><a href=\"Forum.php\">Forum</a></li>
              ";
              if (isset($_SESSION['username']) && ($userType == "admin")){
                 $headerContent .= "<li><a href=\"adminProfile.php\">Admin<span class=\"arrow\"> &#9660;</span></a>
                                        <ul class=\"dropdown\">
                                            <li><a href=\"admin-freelancer-statistics.php\">Freelancer statistics</a></li>
                                            <li><a href=\"admin-client-statistics.php\">Client statistics</a></li>
                                            <li><a href=\"maintain-roles.php\">Maintain roles</a></li>
                                         </ul>
                                      </li>";
              }
            $headerContent.= "</ul>
        </nav>";
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $headerContent .= "
            <nav class=\"header-nav\" id='user-nav'>
            <ul class=\"clearfix\"><li><a href='#'>$username<span class=\"arrow\"> &#9660; </span></a>
                                        <ul class=\"dropdown\">
                                            <li><a href=\"#\">Messages</a></li>
                                         </ul>
                                      </li>
                                      <li><a href=\"logout.php\">| Log out</a></li></ul></nav>
          </span>
        </nav>";
        } else {
            $headerContent .= "<nav class=\"user-nav\">
          <span class=\"user-conrol-links\">
            <a href=\"create-account-page-1.php\">Sign up</a> | <a href=\"login.php\">Log in</a>
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

function startSession(){

<<<<<<< HEAD
    ini_set("session.save_path", "/Applications/MAMP/sessionData");
=======
    ini_set("session.save_path", "/Applications/MAMP/sessionData"
);
>>>>>>> master

    session_start();
};

function checkUserType(){
    require_once ('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){

        $username = $_SESSION['username'];
        $userTypeSQL = "select *
                        from bp_user
                        WHERE username = '$username' or email = '$username'";
        $stmt = $dbConn->query($userTypeSQL);
        while ( $result = $stmt->fetchObject()) {
           $_SESSION['userType'] = $result->userRole;
           $_SESSION['userId'] = $result->userId;
        }
    }
    else{
        $_SESSION['userType'] = 'notLoggedIn';
    };
    $userType = $_SESSION['userType'];
    return $userType;
}
