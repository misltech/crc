<?php

// Resume Existing session

session_start();

include('util.php');
include('db_conn2.php');

// assign variables from POST request

$student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
$chair_email = mysqli_real_escape_string($conn, $_POST['chair_email']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$fw_id = $_SESSION['fw_id'];
$response = mysqli_real_escape_string($conn, $_POST['response']);
if (isset($_POST['send_email'])){
    $send_email = mysqli_real_escape_string($conn, $_POST['send_email']);
}
else{
    $send_email = 'false';
}

if ($response === 'accept'){
/*
    $sql = "SELECT * f19_from academic_dept_info WHERE dept_code='$dept'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {

        $result = $result->fetch_assoc();
        $dean_email = $result['dean_email'];

        $sql_update = "UPDATE s20_application_info SET assigned_to='$dean_email', assigned_when=NOW() WHERE fw_id='$fw_id'";

        if ($conn->query($sql_update) == True){

            $dean_message = "A Fieldwork Application titled, ".$title.", for ".$f_name." ".$l_name." has been assigned to you for review.".
            "\nPlease login at your earliest convenience to review and validate the information included.";
            $subject_dean = "A Fieldwork Application has been Assigned to You";
            $conn->close();
            unset($_SESSION['fw_id']);
            sendEmail($dean_email, $subject_dean, $dean_message);
            setMessage(true, "Application: ".$title.", submitted for further review");
*/
            header("Location: sequence-controller.php");
/*        }
        else{
            echo "Accept condition: Issue updating application_info";
            var_dump($_POST);
        }

    }
    else{
        echo "Accept condition: Issue getting chair email";
    }
*/
}
else{
    $dean_comment = mysqli_real_escape_string($conn, $_POST['reason']);
    $reject_message = "Your Fieldwork application,".$title.", was assigned back to you by the Department Chair 
                        for the following reason(s):<br><br>".$dean_comment."<br><br>
                        Please review the above response and update your application.";
    $subject = $f_name." ".$l_name."\'s Fieldwork Application Needs Further Review";
/*
    $sql = "UPDATE s20_application_info SET assigned_to='$chair_email', assigned_when=NOW() WHERE fw_id='$fw_id'";

    if ($conn->query($sql) == True){
*/
        $sql_util = "UPDATE s20_application_util SET comments='$dean_comment', rejected='1' where fw_id='$fw_id'";

        if ($conn->query($sql_util) == True) {
//            unset($_SESSION['fw_id']);

            if ($send_email == 'true'){
                sendEmail($chair_email, $subject, $reject_message);
                //var_dump($_POST);
//                setMessage(false, "Application Assigned back to the Department Chair for Further Review, Email Sent");
            }
            else{
//                setMessage(false, "Application Assigned back to the Department Chair for Further Review");
            }
            $conn->close();
            header("Location: assign-reject.php");
        }
//    }
}

?>