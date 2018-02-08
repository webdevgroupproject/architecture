<?php

require_once '../PHPGangsta/GoogleAuthenticator.php';

$secret = 'GTXRXE33FJ5WBEHN';

if (isset($_POST['googlecode'])) {
    $code = $_POST['googlecode'];
    $ga = new PHPGangsta_GoogleAuthenticator();
    $result = $ga->verifyCode($secret, $code, 3);

    echo $result;
}