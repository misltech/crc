<?php

// Resume existing session

session_start();
include('util.php');

// check user type

// checkUserType('student');

// Get Variables from POST request

    $form_id = mysql_real_escape_string($_POST['id']);
    $title = mysql_real_escape_string($_POST['app_name']);
    $semester = mysql_real_escape_string($_POST['semester']);
    $year = mysql_real_escape_string($_POST['year']);
    $class_num = mysql_real_escape_string($_POST['course_num']);
    $grade = mysql_real_escape_string($_POST['mode']);
    $credit = mysql_real_escape_string($_POST['credit']);

// Connect to DB and build MySQL query

include('db_conn2.php');

    $sql =  "UPDATE s20_application_info set semester='$semester', name='$title', year='$year', 
        class_number='$class_num', grade_mode='$grade', credits='$credit' where fw_id='$form_id'";

    if($conn->query($sql) == True){

// Create application_util row if none exists

        $sql_util = "INSERT into s20_application_util (fw_id) VALUES ('$form_id')";
        $conn->query($sql_util);

        setMessage(true, "Successfully updated application");
//         if (isset($_SESSION['edit_return'])) {
//             $redirect = $_SESSION['edit_return'];
//             $conn->close();
//             header("Location: ../".$redirect."");
//         }
//         else{
// //            include('sequence-controller.php');
// //            echo $destination;
//             $conn->close();
//             header("Location: sequence-controller.php");
//             //header("Location: ../student-application2.php");
//         }
            $conn->close();
            header("Location: sequence-controller.php");
    }
    else{
        $conn->close();
        setMessage(false, "We Have a Problem");
        header("Location: ../student-application1.php");
    }



?>