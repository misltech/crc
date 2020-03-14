<?php
include('../skeleton.head.php');
session_start();

// LO_Select
$sID = $_POST["studentID"];
$slo1 = $_POST["slo1"];
$slo2 = $_POST["slo2"];
$slo3 = $_POST["slo3"];
$slo4 = $_POST["slo4"];
$alo = $_POST["alo"];
$response = $_POST["response"];
$Reasoning = $_POST["Reasoning"];


// Verify Infomation


require('db_conn.php');

//Record Repsonse into ProfReview Table

mysqli_query($mysqli, "INSERT INTO ProfReview (studentID, learn_obj1, learn_obj2, learn_obj3, learn_obj4, ProfResponse, ProfReasoning, alo)
			VALUES('$sID', '$slo1', '$slo2', '$slo3', '$slo4', '$response','$Reasoning', '$alo')");

echo 'Response Recorded for Student ID: ', $sID, "<br>",
'Learning Objective 1: ', $slo1, "<br>",
'Learning Objective 2: ', $slo2, "<br>", 
'Learning Objective 3: ', $slo3, "<br>",
'Learning Objective 4: ', $slo4, "<br>",
'Additional learning Objective ', $alo, "<br>",
'Status: ', $response, "<br>",
'Reasoning: ', $Reasoning;


$supervisorEmail = "SELECT SupervisorEmail FROM FieldworkWHO";
$StudentEmail = "SELECT StudentEmail FROM FieldworkWHO";

//mail
$to      = $StudentEmail;
$to2 	 = $supervisorEmail;
$subject = 'Professor Reviewed';
$message = 'You have been ' .$response;
$message2 = 'The student has been accepted by the professor please review the application.';
$headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
if($response == accept){
	mail($to2, $subject, $message2, $headers);
}
include('../skeleton.foot.php');
?>