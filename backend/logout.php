<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// remove all session variables
session_unset();

// destroy the session 
session_destroy();

echo("You have logged out. Redirecting you...");

header("Location: ../login.php");
?>