<?php

// Resume Existing session

session_start();

include_once('util.php');
include_once('db_conn2.php');

// assign variables from POST request

$student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
$instructor_email = mysqli_real_escape_string($conn, $_POST['instructor_email']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$fw_id = $_SESSION['fw_id'];
$response = mysqli_real_escape_string($conn, $_POST['response']);
$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
$l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
if (isset($_POST['send_email'])){
    $send_email = mysqli_real_escape_string($conn, $_POST['send_email']);
}
else{
    $send_email = 'false';
}

if ($response === 'accept'){

    $sql = "SELECT * from s20_academic_dept_info WHERE dept_code='$dept'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {

        $result = $result->fetch_assoc();
        $chair_email = $result['chair_email'];
/*
        $sql_update = "UPDATE application_info SET assigned_to='$chair_email', assigned_when=NOW() WHERE fw_id='$fw_id'";

        if ($conn->query($sql_update) == True){

            $sql_util = "UPDATE application_util SET comments='', rejected='0' where fw_id='$fw_id'";

            if ($conn->query($sql_util) == True) {
                $chair_message = "A Fieldwork Application titled, ".$title." for ".$f_name." ".$l_name." has been assigned to you for review.".
                "\nPlease login at your earliest convenience to review and validate the information included.";
                $subject_chair = "A Fieldwork Application has been Assigned to You";
                $conn->close();
                unset($_SESSION['fw_id']);
                sendEmail($chair_email, $subject_chair, $chair_message);
                setMessage(true, "Application: ".$title.", submitted for further review");
*/
                header("Location: ../employer-review2.php");
/*            }
//        }
        else{
            echo "Accept condition: Issue updating application_info";
            var_dump($_POST);
        }
*/
    }
    else{
        echo "Accept condition: Issue getting chair email";
    }
}
else{
    $employer_comment = mysqli_real_escape_string($conn, $_POST['reason']);
    $reject_message = "Your Fieldwork application, ".$title.", was assigned back to you by the Employer 
                        for the following reason(s):<br><br>".$employer_comment."<br><br>
                        Please review the above response and update your application.";
    $subject = $f_name." ".$l_name."\'s Fieldwork Application Needs Further Review";
/*
    $sql = "UPDATE application_info SET assigned_to='$instructor_email', assigned_when=NOW() WHERE fw_id='$fw_id'";

    if ($conn->query($sql) == True){
*/
        $sql_util = "UPDATE s20_application_util SET comments='$employer_comment', rejected='1' where fw_id='$fw_id'";

        if ($conn->query($sql_util) == True) {
            if ($send_email = 'true') {
                sendEmail($instructor_email, $subject, $reject_message);
//                setMessage(false, "Application Assigned back to the Instructor for Further Review, Email Sent");
            }
            else {
//                setMessage(false, "Application Assigned back to the Instructor for Further Review");
            }
            $conn->close();
            header("Location: assign-reject.php");
        }
//    }
}

?>