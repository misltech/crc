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


//mysqli_query($mysqli,"REPLACE INTO FieldworkDECISION (CRCDec) VALUES('$response')");
//mysqli_query($mysqli,"REPLACE INTO FieldworkCOMMENT (CRCCom) VALUES('$reason')");

$CRCEmail = "SELECT R&REmail FROM FieldworkWHO";
$StudentEmail = "SELECT StudentEmail FROM FieldworkWHO";

//mail
$to      = $StudentEmail;
$to2 	 = $R&REmail;
$subject = 'CRC Reviewed';
$message = 'You have been ' .$response;
$message2 = 'The student has been accepted by the Career Resource Center please review the application.';
$headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
if ($response == accept) {
    mail($to2, $subject, $message2, $headers);
}
include('../skeleton.foot.php');
