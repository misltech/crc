<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include('../util.php');

if ($_SESSION['user_type'] !== "admin") {
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header("Location: ../../home.php");
} else {
    include('../db_conn2.php');

    $code = mysql_real_escape_string($_POST['deptCode']);
    $ins_course = isset($_POST['instructor_course']) ? 1 : 0;
    $ins_proj = isset($_POST['instructor_project']) ? 1 : 0;
    $ins_emp = isset($_POST['instructor_emp']) ? 1 : 0;
    $emp_proj = isset($_POST['emp_project']) ? 1 : 0;
    $emp_learn = isset($_POST['emp_learning']) ? 1 : 0;
    $ch_course = isset($_POST['chair_course']) ? 1 : 0;
    $ch_proj = isset($_POST['chair_project']) ? 1 : 0;
    $ch_emp = isset($_POST['chair_emp']) ? 1 : 0;
    $ch_learn = isset($_POST['chair_learning']) ? 1 : 0;
    $dean_course = isset($_POST['dean_course']) ? 1 : 0;
    $dean_proj = isset($_POST['dean_project']) ? 1 : 0;
    $dean_emp = isset($_POST['dean_emp']) ? 1 : 0;
    $dean_learn = isset($_POST['dean_learning']) ? 1 : 0;

    $sql = "UPDATE s20_edit_permissions SET 
    instructor_course = $ins_course,
    instructor_project = $ins_proj,
    instructor_emp = $ins_emp,
    emp_project = $emp_proj,
    emp_learning = $emp_learn,
    chair_course = $ch_course,
    chair_project = $ch_proj,
    chair_emp = $ch_emp,
    chair_learning = $ch_learn,
    dean_course = $dean_course,
    dean_project = $dean_proj,
    dean_emp = $dean_emp,
    dean_learning = $dean_learn
    WHERE dept_code = '$code';";
    
    $result = $conn->query($sql);

    if ($result) {
        setMessage(true, "Updated permissions for department code <code>$code</code> successfully.");
    } else {
        setMessage(false, "Department could not be updated. Please contact an administrator.");
    }

    header('Location: ../../admin.php');
}
