<?php
require_once ('scripts/functions.php');
echo startSession();
require_once ('classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Blueprint home");
echo makeHeader();
echo checkUserType();
$userType = checkUserType();
echo $userType;
if ($userType == "admin"){
    echo "logged in as admin";
}
elseif ($userType == "freelancer"){
    echo "logged in as freelancer";
}
else{
    echo "error";
}
echo makePageFooter();
