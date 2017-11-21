<?php
error_reporting(E_ALL); ini_set('display_errors', 'On');
ini_set("session.save_path", "/Applications/MAMP/sessionData");
session_start();

$_SESSION = array();

session_destroy();

header('location: index.php');
exit;
?>