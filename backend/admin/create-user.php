<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include '../util.php';

if ($_SESSION['user_type'] !== "admin") {
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header("Location: ../../home.php");
}
else { 

    include ('../db_conn2.php');

    $passcode = mysqli_real_escape_string($conn, $_POST['passcode']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $profile_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $type = mysqli_real_escape_string($conn, $_POST['profile_type']);

    $sql = "INSERT INTO s20_UserPass (email, profile_id, profile_type, passcode)
            values ('$email', '$profile_id', '$type', '$passcode')";

    if($conn->query($sql) == True){

        setMessage(true, "New $type created: $email");
        header("Location: ../../admin.php");
    }
    else{

        setMessage(false, "Failed to create user.");
        header("Location: ../../admin.php");

    }

}