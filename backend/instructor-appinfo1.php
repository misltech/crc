<?php

// Resume existing session

session_start();
include('util.php');
include('db_conn2.php');

$response = $_POST['response'];
if (isset($_POST['send_email'])){
    $send_email = mysqli_real_escape_string($conn, $_POST['send_email']);
}
else{
    $send_email = 'false';
}

if ($response === 'accept'){

    setMessage(true, "Please Review Employer Information");
    header("Location: sequence-controller.php");

}
else{

// Send Email to student informing them of rejected status

    $_SESSION['student_email'] = $student_email = $_POST['student_email'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $searchKey = $_SESSION['fw_id'];
    $instructor_comment = mysqli_real_escape_string($conn, $_POST['reason']);
    $subject = "Your Fieldwork Application Needs Further Review";
    $reject_message = "Your Fieldwork application, ".$title.", was assigned back to you by your instructor 
                        for the following reason(s):\n\n".$instructor_comment."\n\n
                        Please review the above response and update your application.";

// Upon reject assign application back to Student

    $sql = "UPDATE s20_application_info SET assigned_to='$student_email', assigned_when=NOW() 
            WHERE fw_id='$searchKey'";

    if ($conn->query($sql) == True) {

// Store comments in application_util table

        $sql_util = "UPDATE s20_application_util SET comments='$instructor_comment', rejected='1' where fw_id='$searchKey'";

        if ($conn->query($sql_util) == True) {

            if ($send_email == 'true') {
                sendEmail($student_email, $subject, $reject_message); 
                setMessage(false, "Application Assigned back to Student, Email Sent");
            }
            else {
                setMessage(false, "Application Assigned back to Student"); 
            } 
            unset($_SESSION['fw_id']);
            unset($_SESSION['emp_email']);
            $conn->close();
            header("Location: ../home.php");

        }
    }
    else {
        echo "We Have a Problem";
    }
}

?>