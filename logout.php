<?php
require_once('scripts/functions.php');
echo startSession();

$_SESSION = array();

session_destroy();

header('location: index.php');
exit;
?>