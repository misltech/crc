<?php

// Universal code for checking editing permissions and hiding edit buttons when no auth to edit
//    session_start();

//    include('db_conn2.php');

    $key = $_SESSION['dept'];
    $type = $_SESSION['user_type'];

    $SQL_editChk = "SELECT * from s20_edit_permissions where dept_code='$key'";

    $editPermissions = $conn->query($SQL_editChk);

    if ($editPermissions->num_rows > 0) {

        $editPermissions = $editPermissions->fetch_assoc();

// check user profile type to disable buttons by permission
// assign $_SESSION['user_type'] to local variable

        if ($type === 'instructor') {

            $courseInfo = $editPermissions['instructor_course'];
            $projectInfo = $editPermissions['instructor_project'];
            $empInfo = $editPermissions['instructor_emp'];


        }

        else if ($type === 'employer') {

            $projectInfo = $editPermissions['emp_project'];
            $learningObj = $editPermissions['emp_learning'];

        }
        else if ($type === 'chair') {

            $courseInfo = $editPermissions['chair_course'];
            $projectInfo = $editPermissions['chair_project'];
            $empInfo = $editPermissions['chair_emp'];
            $learningObj = $editPermissions['chair_learning'];

        }
        else if ($type === 'dean') {

            $courseInfo = $editPermissions['dean_course'];
            $projectInfo = $editPermissions['dean_project'];
            $empInfo = $editPermissions['dean_emp'];
            $learningObj = $editPermissions['dean_learning'];

        }

        else {

// Code that would kill page as user not of above type shouldnt be seeing this page

        }

        //echo ('<h1>edit code works for user of type='.$type.'</h1>');
    }

// Check email permissions

    $sql_emailChk = "SELECT * from s20_email_permissions where dept_code='$key'";

    $emailPermissions = $conn->query($sql_emailChk);

    if ($emailPermissions->num_rows > 0) {

        $emailPermissions = $emailPermissions->fetch_assoc();

        if ($type == 'student') {
            $sendEmail = $emailPermissions['student_send'];
        }
        else if ($type == 'instructor') {
            $sendEmail = $emailPermissions['instructor_send'];
            $rejectEmail = $emailPermissions['instructor_reject'];
        }
        else if ($type == 'employer') {
            $sendEmail = $emailPermissions['employer_send'];
            $rejectEmail = $emailPermissions['employer_reject'];
        }
        else if ($type == 'chair') {
            $sendEmail = $emailPermissions['chair_send'];
            $rejectEmail = $emailPermissions['chair_reject'];            
        }
        else if ($type == 'dean') {
            $sendEmail = $emailPermissions['dean_send'];
            $rejectEmail = $emailPermissions['dean_reject'];            
        }
        else {
// Code that would kill page as user not of above type shouldnt be seeing this page            
        }

//        echo "<h1>Email Permissions Code is Working for user type".$type."</h1>";
    }

?>