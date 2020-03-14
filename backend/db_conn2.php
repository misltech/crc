<?php

$server = 'localhost';
$user = 'p_f18_2';
$pass = 'tt5nyq';
$db = 'p_f18_2_db';

// Connect to database
$conn = new mysqli($server, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
