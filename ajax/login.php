<?php
//Anthony Wilkinson built using these tutorials for guidance
//https://www.youtube.com/watch?v=uVdu4war_Uo
//http://hazardedit.com/
ini_set("session.save_path", "/Applications/MAMP/sessionData");
session_start();

require_once '../PHPGangsta/GoogleAuthenticator.php';

$secret = $_SESSION['secret'];

if (isset($_POST['google_code'])) {
    $code = $_POST['google_code'];
    $ga = new PHPGangsta_GoogleAuthenticator();
    $result = $ga->verifyCode($secret, $code, 3);

    echo $result;
}