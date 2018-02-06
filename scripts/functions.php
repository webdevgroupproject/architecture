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
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="scripts/createModal.js"></script>
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
  $headerContent ="
		<header class\"navbar-fixed-top\">
	    <div class=\"menu-wrap\">
				<div class=\"logo-contain\">
					<a href=\"index.php\"><img src=\"images/logo-test.png\" alt=\"Blueprint company logo\" id='logoImg'></a>
				</div>
	    	<nav class=\"header-nav\">
	        <ul class=\"clearfix\">
	          <li>
							<a href=\"events.php\">Events</a>
						</li>
	          <li>
							<a href=\"Forum.php\">Forum</a>
						</li>
						<li>
							<a href=\"index.php#howitworks\">How It Works</a>
						</li>
  					";
            if (isset($_SESSION['username']) && ($userType == "admin")){
            	$headerContent .= "
								<li><a href=\"profile.php\">Admin<span class=\"arrow\"> &#9660;</span></a>
	                <ul class=\"dropdown\">
	                    <li><a href=\"admin-freelancer-statistics.php\">Freelancer statistics</a></li>
	                    <li><a href=\"admin-client-statistics.php\">Client statistics</a></li>
	                    <li><a href=\"maintain-roles.php\">Maintain roles</a></li>
	                    <li><a href=\"admin-reported-messages.php\">Reported messages</a></li>
	                    <li><a href=\"admin-reported-forum-posts.php\">Reported forum posts</a></li>
	                 </ul>
	              </li>
							";
            }
            $headerContent.= "
							</ul>

						";
						//</nav>
        		if (isset($_SESSION['username'])) {
          		$username = $_SESSION['username'];
          		$headerContent .= "
          			<div class=\"header-nav\" id='user-nav' style='float: right; width: 40%;'>
          				<ul class=\"clearfix\" style='float: right; width: auto;'>
										<li style='margin: 0; padding: 0;'>
											<a href='profile.php'>$username<span class=\"arrow\"> &#9660;</span></a>
                    	<ul class=\"dropdown\">
                       <li><a href=\"notifications.php\">Notifications</a></li>
                       <li><a href=\"messaging.php\">Messages</a></li>
                       <li><a href=\"editPofile.php\">Edit profile</a></li>
                     	</ul>
                  	</li>
										<li>
											<a href=\"logout.php\">Log out</a>
										</li>
									</ul>
								</div>
          		";
        		} else {
            	$headerContent .= "
								<div class=\"user-nav\">
          				<div class=\"user-conrol-links\">
									<div>
										<a href=\"#\" class=\"button\">Post a Project</a>
										</div>
				            <a href=\"create-account-page-1.php\">Sign up</a>
											<a href=\"login.php\">Log in</a>
				          </div>
				        </div>
							";
        		}
    				$headerContent .= "
							</nav>
							</div>
						</header>
						<main>
						";
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

    ini_set("session.save_path", "/Applications/MAMP/sessionData");


//    ini_set("session.save_path", "/xampp1/sessionData");



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

function checkProStatus(){
    require_once ('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true){

        $username = $_SESSION['username'];
        $userTypeSQL = "select *
                        from bp_user
                        WHERE username = '$username' or email = '$username'";
        $stmt = $dbConn->query($userTypeSQL);
        while ( $result = $stmt->fetchObject()) {
            $_SESSION['pro'] = $result->pro;
        }
    }
    else{
        $_SESSION['pro'] = '0';
    };
    $pro = $_SESSION['pro'];
    return $pro;
}

function notLoggedRedirect(){

    header('Location: http://localhost/architecture/index.php');
};

function removeNotif($notifID){
    require_once ('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();

    $notifDLT = "DELETE FROM `bp_notification`
    WHERE `bp_notification`.`notificationID` = $notifID";

    if ($dbConn->query($notifDLT) === TRUE) {

    } else {
      echo "Error deleting record: " . $conn->error;
    }
};

//----------Sign up Functions----------//

function signupPage1() {

	if(isset($_POST['submit'])) {

    //Retrieving the variables from the form
		$username = $_POST['username'];
 		$email = $_POST['Email'];
 		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];
 		$passwordHint = $_POST['passwordHint'];
		$tandc = $_POST['tandc'];
		$signupForm1 = $_POST['signupForm1'];

		//Insertion SQL statement that uses the values entered into the web form via the exact attribute
		//names defined in the database. This allows the exact information to be placed in each relevant column

			if(($password == $confirmPassword) && ($tandc == true) && ($signupForm1.radio == 'freelancer' || $signupForm1.radio == 'client' )) {

					$sql = "INSERT INTO bp_user (username, email, password, passwordHint)
											 VALUES('$username',
															'$email',
															'$password',
															'$passwordHint')";
			}
			return header('Location: http://localhost:8888/architecture/Create-Account-Page-2-Client.php');
		}
};
