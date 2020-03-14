<?php
include 'util.php';
session_start();

// remove all session variables
session_unset();

// destroy the session 
session_destroy();

echo("You have logged out. Redirecting you...");

session_start();
setMessage(True, "You have logged out. Goodbye!");

header("Location: ../login.php");
?>