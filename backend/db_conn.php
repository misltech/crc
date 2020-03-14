<?php

$server = 'localhost';
$user = 'p_f18_2';
$pass = 'tt5nyq';
$db = 'p_f18_2_db';

// Connect to database
$mysqli = new mysqli($server, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Hmm, something went wrong. Please try again or contact an administrator.');
}

?>