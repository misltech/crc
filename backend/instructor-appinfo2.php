<?php

// Resume existing session

session_start();
include('util.php');

// connect to DB 

include('db_conn2.php');

$response = $_POST['response'];
if (isset($_POST['send_email'])){
    $send_email = mysqli_real_escape_string($conn, $_POST['send_email']);
}
else{
    $send_email = 'false';
}

if ($response === 'accept'){

    $pw = generatePassword(8);
    $subject = "Welcome!";
    $id = "E" . $_POST['emp_id'];
    $email = $_SESSION['emp_email'];
    $welcomeMSG = "Welcome to the Fieldwork Application System!\nYour password is: $pw\n"
    . "If you forget, please use the ID \"$id\" to reset it.";

    $check_sql = "SELECT * FROM s20_UserPass WHERE email='$email' and profile_type='employer'";

    if ($conn->query($check_sql) == True) {
        $sql_update = "UPDATE s20_employer_info SET validated='1' where email='$email'";
        $conn->query($sql_update);

        setMessage(true, "Employer profile verified.");
    } else {
        $sql = "INSERT INTO s20_UserPass (email, profile_id, profile_type, passcode)
        values ('$email', '$id', 'employer', '$pw')";

        if ($conn->query($sql) == True) {

            $sql_update = "UPDATE s20_employer_info SET validated='1' where email='$email'";
            $conn->query($sql_update);
            
            sendEmail($email, $subject, $welcomeMSG);
            setMessage(true, "Employer profile created.");
        } else{

            setMessage(false, "Insertion of employer profile failed.");
        }
    }
    $conn->close();
    header("Location: sequence-controller.php");
} else {

    $searchKey = $_SESSION['fw_id'];
    $student_email = $_SESSION['student_email'];
    $title = $_SESSION['title'];
    $instructor_comment = $_POST['reason'];
    $subject = "Your Fieldwork Application Needs Further Review";
    $reject_message = "Your Fieldwork application, ".$title.", was assigned back to you by your instructor 
                        for the following reason(s):\n\n".$instructor_comment."\n\n
                        Please review the above response and update your application.";

// Upon reject assign application back to Student
/*
    $sql = "UPDATE s20_application_info SET assigned_to='$student_email', assigned_when=NOW() 
            WHERE fw_id='$searchKey'";

    if ($conn->query($sql) == True) {

// Store comments in application_util table
*/
        $sql_util = "UPDATE s20_application_util SET comments='$instructor_comment', rejected='1' where fw_id='$searchKey'";

        if ($conn->query($sql_util) == True) {

            if ($send_email == 'true') {
                sendEmail($student_email, $subject, $reject_message); 
         //       setMessage(false, "Application Assigned back to Student, Email Sent");
            }
            else {
         //       setMessage(false, "Application Assigned back to Student"); 
            }
            $conn->close();
            header("Location: assign-reject.php");

        }
    }
/*
    else {
        echo "We Have a Problem";
    }
}
*/ 
?>