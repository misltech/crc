<?php
//resume existing session;
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include('util.php');
include('db_conn2.php');

// check for correct user type

// Declare variables from POST request

$email = mysqli_real_escape_string($conn, $_POST['email']);
$dept_name = mysqli_real_escape_string($conn, $_POST['dept']);
$instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
$name = 'New Application';

// Connect to DB and build MySQL query

$sql = "INSERT into s20_application_info (dept_code, student_email, instructor_email, assigned_to,
        assigned_when, name) values ('$dept_name', '$email', '$instructor', '$email', now(), '$name')";

if ($conn->query($sql) == True){

    setMessage(true, "Application created for User: " .$email);
    
}
else{

    setMessage(false, "We have a problem creating an application");

}

$conn->close();
header("Location: ../secretary.php");
// 
?>