<?php

// Resume Existing Session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('util.php');

if ($_SESSION["user_type"] === 'student') {
    include('../components/blame.php');
    include('../components/progress-bar.php');
}
// This page will query DB for FW Applications Assigned to User and display results as clickable links

$user_email = $_SESSION['id_key'];
/*
if ($_SESSION['user_type'] === 'student') {
    $link_root = 'student-application1.php?id=';
}
if ($_SESSION['user_type'] === 'instructor') {
    $link_root = 'instructor-review1.php?id=';
}
if ($_SESSION['user_type'] === 'employer') {
    $link_root = 'employer-review1.php?id=';
}
if ($_SESSION['user_type'] === 'chair') {
    $link_root = 'chair-review1.php?id=';
}
if ($_SESSION['user_type'] === 'dean') {
    $link_root = 'dean-review1.php?id=';
}
*/

    $link_root = 'backend/sequence-controller.php?id=';
// Connect to DB and build MySQL query

include('db_conn2.php');

$sql = "SELECT fw_id, assigned_to, dept_code, class_number, student_email FROM s20_application_info WHERE student_email = '$user_email'";

if ($_SESSION["user_type"] !== 'student') {
    $sql = "SELECT fw_id, dept_code, class_number, student_email from s20_application_info where assigned_to = '$user_email'";
}
alert($user_email);
$result = $conn->query($sql);
/*
$data = $result->fetch_assoc();

$app_id = $data['fw_id'];

$sql_rejectChk = "SELECT * from application_util where fw_id='$app_id'";

    $rejectChk = $conn->query($sql_rejectChk);

    if ($rejectChk->num_rows > 0) {
        $rejectChk = $rejectChk->fetch_assoc();
    }
*/
// Check if data is returned by query
if ($result === false) {
    setMessage(false, "Failed to load applications!");
} else {
    if ($result->num_rows >0) {
        // Build Unordered List of links
        //echo "<div id = 'applications'>";
        //echo "<ul style='list-style-type:none;'>";
        //setMessage(true, "Loaded Applications");
        // populate list with search results
        
        $msg = "<p>You have " . $result->num_rows . " application" .
            (($result->num_rows > 1) ? "s" : "") . " " .
            (($_SESSION['user_type'] === "student") ? "in the system" : "assigned to you") . ".</p>";
        echo $msg;
        
        while ($row = $result->fetch_assoc()) {
            //retrieve student info to display for each application
            $email = $row['student_email'];

            $student_sql = "SELECT student_first_name, student_last_name FROM s20_student_info WHERE student_email='$email'";
            $student_result = $conn->query($student_sql);
            $student_arr = $student_result->fetch_assoc();

            // Test to display reject message
            $app_id = $row['fw_id'];

            $sql_rejectChk = "SELECT * from s20_application_util where fw_id='$app_id'";

            $rejectChk = $conn->query($sql_rejectChk);

            if ($rejectChk->num_rows > 0) {
                $rejectChk = $rejectChk->fetch_assoc();
                $rejected = $rejectChk['rejected'];
                $rejectMsg = $rejectChk['comments'];
            }
            // End of reject code

            echo "<hr />";
            $display_string = "{$student_arr['student_first_name']} {$student_arr['student_last_name']} --- Course: {$row['dept_code']} {$row['class_number']}";
            if ($_SESSION['user_type'] === 'student') {
                if ($row['assigned_to'] === $user_email) {
                    
                    echo "<p><a href='".$link_root.$row['fw_id']."&dept=".$row['dept_code']."'>".$display_string."</a></p>";
                 
                    if (isset($rejected)){
                        if ($rejected == '1') {
                            echo "<p style='color:red'>Please Review: ".$rejectMsg."</p>";
                        }
                    }
                    
                } else {
                    echo "<p>".$display_string."</p>";
                }
                include_progress_bar($row['fw_id']);
                echo "<p>&nbsp;</p>";
                include_blame_logic($row['fw_id']);
            } else {
                echo "<p><a href='".$link_root.$row['fw_id']."&dept=".$row['dept_code']."'>".$display_string."</a></p>";
                
                if (isset($rejected)){
                    if ($rejected === '1') {
                        echo "<p style='color:red'>Please Review: ".$rejectMsg."</p>";
                    }
                }
                
            }
            //echo "<li>".$row['name']."</li>";
        }
    } else {
        //setMessage(false, "Failed to Load Results");
        echo "<p>No Applications are Currently Assigned to you</p>";
    }
}

$conn->close();


function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?> 