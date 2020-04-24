<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

//validate();
?>












<!--  Search by email or banner ; They will be able to see list of users current applications -->
 

<!-- $sql = "INSERT into s20_application_info (banner_id,dept_code, semester, year, student_email, instructor_email, class_number, grade_mode, assigned_when, assigned_to) 
        values ('$banner_id','$dept', '$semester' , '$year','$student_email', '$instructor', '$course_num', '$grade' , now(), '$student_email')"; -->

        <!-- $uuid =bin2hex(random_bytes(32)  this is the application id   -->
        <!-- Change fwid to varchar 32 -->

<?php
include_once'components/footer.php';
?>