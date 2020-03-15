<?php

// Resume existing session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include_once('util.php');

// Get fw_id, instructor email from session variable and unset


//$sql = "UPDATE application_info SET assigned_to='$instructor', assigned_when=NOW() WHERE fw_id='$formID'";

//if ($conn->query($sql) == True){
    
header("Location: sequence-controller.php");
/*
else{
    $conn->close();
    echo "We Have a Problem";
}
*/


?>