<?php
// This is a page to redirect application back to previous user upon rejection

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('db_conn2.php');

// Assign session variables locally

$deptKey = $_SESSION['dept'];
$formKey = $_SESSION['fw_id'];
$type = $_SESSION['user_type'];

// Query DB and build array for user sequence

    $sql_userSeq = "SELECT * from s20_user_sequence WHERE dept_code='$deptKey'";
    $usrSeq = $conn->query($sql_userSeq);

    if ($usrSeq->num_rows > 0) {
        $usrSeq = $usrSeq->fetch_assoc();

// Get user order

        $currentUser = intval($usrSeq[$type]);
        $currentUser--;
        $currentUser = strval($currentUser);

        $student = $usrSeq['student'];
        $instructor = $usrSeq['instructor'];
        $employer = $usrSeq['employer'];
        $chair = $usrSeq['chair'];
        $dean = $usrSeq['dean'];
        $recreg = $usrSeq['recreg'];

        $order[$student] = "student";
        $order[$instructor] = "instructor";
        $order[$employer] = "employer";
        $order[$chair] = "chair";
        $order[$dean] = "dean";
        $order[$recreg] = "recreg";

//        echo $currentUser;
//        var_dump($order);

        $prevUser = $order[$currentUser];

// Check if reject will go to employer, if so look at next user behind employer to redirect application to.

        if ($prevUser == 'employer') {
            $currentUser = intval($currentUser)-1;
            $currentUser = strval($currentUser);
            $prevUser = $order[$currentUser];
        }

        $emailKey = $prevUser."_email";

// Query database again for user's         

        if ($prevUser == 'student' || $prevUser == 'instructor') {

            $sql_getUser = "SELECT student_email, instructor_email from s20_application_info where fw_id='$formKey'";
            $result = $conn->query($sql_getUser);

            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                $emailAssignment = $result[$emailKey];
            }
        }
        if ($prevUser == 'chair' || $prevUser == 'dean') {

            $sql_getUser = "SELECT chair_email, dean_email FROM s20_academic_dept_info WHERE dept_code='$deptKey'";
            $result = $conn->query($sql_getUser);

            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                $emailAssignment = $result[$emailKey];
            }
        }

//        

// Update application_info with new assigned_to value

        $sql_update = "UPDATE s20_application_info SET assigned_to='$emailAssignment', assigned_when=NOW() where fw_id='$formKey'";
   
        if ($conn->query($sql_update) == True) {
            echo $emailAssignment;
            unset($_SESSION['emp_email']);
            unset($_SESSION['student_email']);
            unset($_SESSION['dept']);
            unset($_SESSION['instructor_email']);
            unset($_SESSION['fw_id']);
            unset($_SESSION['emp_email']);
            unset($_SESSION['title']);

            $conn->close();
            header("Location: ../home.php");
        }
    }
?>