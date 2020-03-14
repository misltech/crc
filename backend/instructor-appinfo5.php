<?php

// Resume Existing Session

session_start();
include('util.php');
include('db_conn2.php');

// assign session variables and unset for submission

$emp_email = $_SESSION['employer_email'];
$student_email = $_SESSION['student_email'];
$fw_id = $_SESSION['fw_id'];
$dept = $_SESSION['dept'];

// assign POST request variables

$f_name = mysqli_escape_string($conn, $_POST['first_name']);
$l_name = mysqli_escape_string($conn, $_POST['last_name']);
$title = mysqli_escape_string($conn, $_POST['title']);

// Connect to DB and build MySQL query



$sql_update = "UPDATE s20_application_info SET assigned_to='$emp_email', assigned_when=NOW() WHERE fw_id='$fw_id'";

    if ($conn->query($sql_update) == True) {

// Upon successful update send email to employer to inform them of application assignment

    $sql_util = "UPDATE s20_application_util SET comments='', rejected='0' where fw_id='$fw_id'";

        if ($conn->query($sql_util) == True) {

            $subject_employer = "Fieldwork Application has been Assigned to You";
            $emp_message = "A Fieldwork Application titled, ".$title.", for ".$f_name." ".$l_name." has been assigned to you for review.".
            "\nPlease login at your earliest convenience to review and validate the information included.";

            sendEmail($emp_email, $subject_employer, $emp_message);


            $subject_student = "Your Application has been Assigned to your Employer for Review";
            $student_message = "Your Fieldwork Application titled,".$title.", has been approved by your instructor and has been assigned to your employer for further review." . 
            "\nWe will continue to send updates as the application progresses through the approval process.";

            sendEmail($student_email, $subject_student, $student_message);
            

            //setMessage(true, "Application has been sucessfully assigned to Employer");
        }
    }

    $conn->close();
    header("Location: sequence-controller.php");

?>
