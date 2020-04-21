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

    $name = mysqli_real_escape_string($conn, $_POST['deptName']);
    $code = mysqli_real_escape_string($conn, $_POST['deptCode']);
    $dean = mysqli_real_escape_string($conn, $_POST['deanEmail']);
    $chair = mysqli_real_escape_string($conn, $_POST['chairEmail']);
    //$dean = mysql_real_escape_string(get_index_of_assoc($_POST, 2));
    //$chair = mysql_real_escape_string(get_index_of_assoc($_POST, 3));

    // Editing Permissions - Form Data
    $ins_course = isset($_POST['ins_course']) ? 1 : 0;
    $ins_proj = isset($_POST['ins_proj']) ? 1 : 0;
    $ins_emp = isset($_POST['ins_emp']) ? 1 : 0;
    $emp_proj = isset($_POST['emp_proj']) ? 1 : 0;
    $emp_learn = isset($_POST['emp_learn']) ? 1 : 0;
    $ch_course = isset($_POST['ch_course']) ? 1 : 0;
    $ch_proj = isset($_POST['ch_proj']) ? 1 : 0;
    $ch_emp = isset($_POST['ch_emp']) ? 1 : 0;
    $ch_learn = isset($_POST['ch_learn']) ? 1 : 0;
    $dean_course = isset($_POST['dean_course']) ? 1 : 0;
    $dean_proj = isset($_POST['dean_proj']) ? 1 : 0;
    $dean_emp = isset($_POST['dean_emp']) ? 1 : 0;
    $dean_learn = isset($_POST['dean_learn']) ? 1 : 0;

    // E-mail Permissions - Form Data
    $stu_send = isset($_POST['stu_send']) ? 1 : 0;
    $stu_rem = isset($_POST['stu_rem']) ? 1 : 0;
    $inst_send = isset($_POST['inst_send']) ? 1 : 0;
    $inst_rej = isset($_POST['inst_rej']) ? 1 : 0;
    $inst_rem = isset($_POST['inst_rem']) ? 1 : 0;
    $emp_send = isset($_POST['emp_send']) ? 1 : 0;
    $emp_rej = isset($_POST['emp_rej']) ? 1 : 0;
    $emp_rem = isset($_POST['emp_rem']) ? 1 : 0;
    $chair_send = isset($_POST['chair_send']) ? 1 : 0;
    $chair_rej = isset($_POST['chair_rej']) ? 1 : 0;
    $chair_rem = isset($_POST['chair_rem']) ? 1 : 0;
    $dean_send = isset($_POST['dean_send']) ? 1 : 0;
    $dean_rej = isset($_POST['dean_rej']) ? 1 : 0;
    $dean_rem = isset($_POST['dean_rem']) ? 1 : 0;

    $sql = "INSERT INTO s20_academic_dept_info VALUES ('$code', '$name', '$dean', '$chair');
    UPDATE s20_UserPass SET verified = 0 WHERE email = '$chair' OR email = '$dean';
    INSERT INTO s20_edit_permissions VALUES ('$code', $ins_course, $ins_proj, $ins_emp, $emp_proj, $emp_learn, $ch_course, $ch_proj, $ch_emp, $ch_learn, $dean_course, $dean_proj, $dean_emp, $dean_learn);
    INSERT INTO s20_email_permissions VALUES ('$code', $stu_send, $stu_rem, $inst_send, $inst_rej, $inst_rem, $emp_send, $emp_rej, $emp_rem, $chair_send, $chair_rej, $chair_rem, $dean_send, $dean_rej, $dean_rem);
    ";

    $success = $conn->multi_query($sql);
    while ($conn->more_results()) {
        $success = $success && $conn->next_result();
    }

    if ($success) {
        setMessage(true, "Created department $code successfully. Please have the new chair and dean log in to update their profiles.");
    } else {
        setMessage(false, "Department could not be created. Please contact an administrator.");
    }

    header('Location: ../../admin.php');
}
