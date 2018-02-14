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
			<link rel="stylesheet" type="text/css" href="css/barker-style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="scripts/createModal.js"></script>
      <script src="scripts/timeout.js"></script>
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
							<a href=\"forum.php\">Forum</a>
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
							<form class=\"main-search\" method='get' action=\"searchList.php\">
								<select class='search-select' name='searchChoice'>
									<option value='freelancer'>Freelancers</option>
									<option value='client'>Clients</option>
									<option value='jobs'>Jobs</option>
								</select>
		            <input type='text' autocomplete=\"off\" name='searchInput' placeholder=''/>
		            <button type='submit'><i class=\"material-icons\">search</i></button>
		            <div class='result'></div>
		          </form>
						";
						//</nav>
        		if (isset($_SESSION['username'])) {
          		$username = $_SESSION['username'];
          		$headerContent .= "
          			<div class=\"header-nav\" id='user-nav' style='float: right; width: 30%;'>
          				<ul class=\"clearfix\" style='float: right; width: auto;'>
										<li style='margin: 0; padding: 0;'>
											<a href='profile.php'>$username<span class=\"arrow\"> &#9660;</span></a>
                    	<ul class=\"dropdown\">
                       <li><a href=\"notifications.php\">Notifications</a></li>
                       <li><a href=\"messaging.php\">Messages</a></li>
                       <li><a href=\"profileSettings.php\">Profile Settings</a></li>
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
				            <a href=\"registerPage1.php\">Sign up</a>
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

				<ul class="clearfix">
				    <li>
					    <a href="index.php">Home</a>
					</li>
	                <li>
					    <a href="events.php">Events</a>
					</li>
	                <li>
					    <a href="Forum.php">Forum</a>
					</li>
					<li>
					    <a href="index.php#howitworks">How It Works</a>
					</li>
				</ul>
				<ul class="clearfix socialMedia">
				    <li>
					    <a href="index.php" style="width: 50px; height: 50px;"><img src="images/google.png"></a>
					</li>
	                <li>
					    <a href="events.php"><a href="index.php"><img src="images/facebook2.png"></a>
					</li>
	                <li>
					    <a href="Forum.php"><a href="index.php"><img src="images/twitter2.png"></a>
					</li>
				</ul>
				<p>&copy; Blueprint 2018</p>
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
    //ini_set("session.save_path", "/xampp1/sessionData");
	 //ini_set("session.save_path", "/xampp/sessionData");
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

function addNotification($userID, $link, $jobID, $jAcpt, $return){
    require_once ('classes/databaseConn.php');
    $dbConn = databaseConn::getConnection();


		if (!isset($jobID)) {
			$jobID = null;
		}

		if (!isset($jAcpt)) {
			$jAcpt = null;
		}

    $notifINST = "INSERT INTO bp_notification (userID, link, time, date, markRead, jobID, jobAcceptID)
    VALUES ($userID, $link, now(), now(), '0', $jobID, $jAcpt)";

		$queryresult = $dbConn->prepare($notifINST);
		$queryresult->execute();

		if ($queryresult) {
		    return addNotification();
		} else {
		    echo "failed";
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

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
