<?php
session_start();

include('../util.php');

if ($_SESSION['user_type'] !== "admin") {
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header("Location: ../../home.php");
} else {
    include('../db_conn2.php');

    $code = mysql_real_escape_string($_POST['deptCode']);

    $sql = "DELETE FROM s20_edit_permissions WHERE dept_code = '$code';
    DELETE FROM s20_email_permissions WHERE dept_code = '$code';
    DELETE FROM s20_academic_dept_info WHERE dept_code = '$code';";

    $success = $conn->multi_query($sql);
    while ($conn->more_results()) {
        $success = $success && $conn->next_result();
    }

    if ($success) {
        setMessage(true, "Deleted department $code successfully.");
    } else {
        setMessage(false, "Department could not be deleted. Please contact an administrator.");
    }

    header('Location: ../../admin.php');
}
