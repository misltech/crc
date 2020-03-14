<?php
// Resume session
session_start();
include('util.php');

// Connect to DB

include('db_conn2.php');

// Get variables from POST request from secretary.php

$search_id = mysqli_real_escape_string($conn, $_POST['search_id']);
$_SESSION['banner_id'] = $search_id;

// Build query

$sql = "SELECT * from s20_UserPass where banner_id = '$search_id' and profile_type = 'student'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $_SESSION['search_results'] = $result->fetch_assoc();
    setMessage(true, "Found User!");
    header("Location: ../secretary.php");
}
else{
    $_SESSION['search_results'] = "False";
    $_SESSION['banner_id'] = $search_id;
    setMessage(false, "No User Found");
    header("Location: ../secretary.php");
}

?>
