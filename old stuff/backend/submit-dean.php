<?php
include('../skeleton.head.php');
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// initializing variables
$errors = array(); 
$response = $_POST["response"];
$reason = $_POST["reason"];

// connect to the database
require('db_conn.php');


mysqli_query($mysqli,"INSERT INTO FieldworkDECISION (DeanDec) VALUES('$response')");
mysqli_query($mysqli,"INSERT INTO FieldworkCOMMENT (DeanCom) VALUES('$reason')");


$CRCEmail = "SELECT CRCEmail FROM FieldworkWHO";
$StudentEmail = "SELECT StudentEmail FROM FieldworkWHO";

//mail
$to      = $StudentEmail;
$to2 	 = $CRCEmail;
$subject = 'Dean Reviewed';
$message = 'You have been ' .$response;
$message2 = 'The student has been accepted by the Dean please review the application.';
$headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
if($response == accept){
	mail($to2, $subject, $message2, $headers);
}
include('../skeleton.foot.php');
?>