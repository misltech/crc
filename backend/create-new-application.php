<?php
//resume existing session;
session_start();

include('util.php');

// Connect to DB and build MySQL query

include('db_conn2.php');

// check for correct user type

// Declare variables from POST request
$banner_id = $_SESSION['banner_id'];
$student_email = $_SESSION['search_results']['email'];
$dept= mysqli_real_escape_string($conn,$_POST['dept']);
$instructor = mysqli_real_escape_string($conn,$_POST['instructor']);
$course_num = mysqli_real_escape_string($conn,$_POST['course_num']);
$semester = mysqli_real_escape_string($conn,$_POST['semester']);
$year = mysqli_real_escape_string($conn,$_POST['year']);
$grade = mysqli_real_escape_string($conn,$_POST['mode']);
// $name = 'New Application'; 



$sql = "INSERT into s20_application_info (banner_id,dept_code, semester, year, student_email, instructor_email, class_number, grade_mode, assigned_when, assigned_to) 
        values ('$banner_id','$dept', '$semester' , '$year','$student_email', '$instructor', '$course_num', '$grade' , now(), '$student_email')";

// $sql = "INSERT into s20_application_info (semester, year, student_email, course_num, grade_mode, assigned_when) 
//         values ('$semester' , '$year','$student_email', '$course_num', '$grade', now())";

// if ($conn->query($sql) == True){

//     setMessage(true, "Application created for User: " .$student_email);
    
// }
if(mysqli_query($conn, $sql)) {
    setMessage(true, "Application created for User: " .$student_email);
}
else{
    $msg = $banner_id." ,".$dept." ,".$semester." ,".$year."  ,".$student_email." ,".$course_num." ,".$grade;
    setMessage(false, $msg);

}

$conn->close();
unset($_SESSION['search_results']);
header("Location: ../secretary.php");
// 
?>