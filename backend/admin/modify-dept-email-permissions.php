<?php
session_start();

include('../util.php');

if ($_SESSION['user_type'] !== "admin") {
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header("Location: ../../home.php");
} else {
    include('../db_conn2.php');

    $code = mysql_real_escape_string($_POST['deptCode']);
    $student_send = isset($_POST['student_send']) ? 1 : 0;
    $student_remind = isset($_POST['student_remind']) ? 1 : 0;
    $instructor_send = isset($_POST['instructor_send']) ? 1 : 0;
    $instructor_reject = isset($_POST['instructor_reject']) ? 1 : 0;
    $instructor_remind = isset($_POST['instructor_remind']) ? 1 : 0;
    $employer_send = isset($_POST['employer_send']) ? 1 : 0;
    $employer_reject = isset($_POST['employer_reject']) ? 1 : 0;
    $employer_remind = isset($_POST['employer_remind']) ? 1 : 0;
    $chair_send = isset($_POST['chair_send']) ? 1 : 0;
    $chair_reject = isset($_POST['chair_reject']) ? 1 : 0;
    $chair_remind = isset($_POST['chair_remind']) ? 1 : 0;
    $dean_send = isset($_POST['dean_send']) ? 1 : 0;
    $dean_reject = isset($_POST['dean_reject']) ? 1 : 0;
    $dean_remind = isset($_POST['dean_remind']) ? 1 : 0;

    $sql = "UPDATE s20_email_permissions SET 
    student_send = $student_send,
    student_remind = $student_remind,
    instructor_send = $instructor_send,
    instructor_reject = $instructor_reject,
    instructor_remind = $instructor_remind,
    employer_send = $employer_send,
    employer_reject = $employer_reject,
    employer_remind = $employer_remind,
    chair_send = $chair_send,
    chair_reject = $chair_reject,
    chair_remind = $chair_remind,
    dean_send = $dean_send,
    dean_reject = $dean_reject,
    dean_remind = $dean_remind
    WHERE dept_code = '$code';";

    $result = $conn->query($sql);

    if ($result) {
        setMessage(true, "Updated permissions for department code <code>$code</code> successfully.");
    } else {
        setMessage(false, "Department could not be updated. Please contact an administrator.");
    }

    header('Location: ../../admin.php');
}
