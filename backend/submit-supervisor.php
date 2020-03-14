<?php
include('../skeleton.head.php');
session_start();

// Supervisor Review select
$sID = $_POST["studentID"];
$intDescript = $_POST["intDescript"];
$response = $_POST["supResponse"];
$reasoning = $_POST["supReasoning"];

// Verify Infomation


require('db_conn.php');

//Record Repsonse into ProfReview Table

mysqli_query($mysqli, "INSERT INTO SuperReview (studentID, description, superResponse, superReasoning)
			VALUES('$sID', '$intDescript', '$response','$reasoning')");

echo 'Response Recorded for Student ID: ', $sID;

$chairEmail = "SELECT ChairEmail FROM FieldworkWHO";
$StudentEmail = "SELECT StudentEmail FROM FieldworkWHO";


//mail
$to      = $StudentEmail;
$to2 	 = $chairEmail;
$subject = 'Supervisor Reviewed';
$message = 'You have been ' .$response;
$message2 = 'The student has been accepted by the Supervisor please review the application.';
$headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
if($response == accept){
	mail($to2, $subject, $message2, $headers);
}
include('../skeleton.foot.php');
?>