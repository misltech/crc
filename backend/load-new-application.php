<?php

// Resume existing session

session_start();
include('util.php');

// check user type

//checkUserType('student');

// Connect to DB and build MySQL query

include('db_conn2.php');

$student_id = $_SESSION['banner_id'];
$student_email = $_SESSION['search_results']['email'];


/**
 *  Uses similar file as load-appinfo1.php
 *  Secretary fills out the course information before sending it to studen
 *  This just loads in a static application for secretary to fill out 
 */

// $sql = "SELECT * from s20_application_info where fw_id='$key'";

// $result = $conn->query($sql);

//     if($result->num_rows > 0){
//         $result = $result->fetch_assoc();
//         $sem = $result["semester"];
//         $cred = $result["credits"];
//         $yr = $result["year"];
//         $num = $result["class_number"];
//         $mod = $result["grade_mode"];
//         $name = $result["name"];

//         if ($sem != "") {
//             $semester = "<option id=\"1\" value=\"$sem\">$sem</option>";
//         }
//         else {
//             $semester = "<option value=\"\">Enter Academic Semester</option>";
//         }
//         if ($yr != "") {
//             $year = "<option id=\"1\" value=\"$yr\">$yr</option>";
//         }
//         else {
//             $year = "<option value=\"\">Enter Academic Year</option>";
//         }
//         if ($num != "") {
//             $course_num = "<option id=\"1\" value=\"$num\">$num</option>";
//         }
//         else {
//             $course_num = "<option value=\"\">Enter Course Number</option>";
//         }
//         if ($mod != "") {
//             $mode = "<option id=\"4\" value=\"$mod\">$mod</option>";
//         }
//         else {
//             $mode = "<option value=\"\">Enter Grading Mode</option>";
//         }
//         if ($cred != "") {
//             $credit = "<option id=\"5\" value=\"$cred\">$cred</option>";
//         }
//         else {
//             $credit = "<option value=\"\">Enter Academic Credit</option>";
//         }

    echo "<form method=\"post\" action=\"backend/create-new-application.php\">";
        echo "<h3>Fieldwork Course Information</h3><br>";

        echo "<p>Banner ID : </p>";
        if(isset($_SESSION['search_results']['banner_id'])) {
            echo "<p name='banner_id'>".$_SESSION['search_results']['banner_id']."</p>";
        }
        echo "<br>";

        echo "<p>Student Email: </p>";
            if(isset($_SESSION['search_results']['banner_id'])) {
                echo "<p name='student_email'>".$_SESSION['search_results']['email']."</p>";
            }
            else {
                echo "<input type='text' name='student_email' placeholder='Enter Student Email'>";
            }

        echo "<br><input type='hidden' name='user_type' value='student'>";
        echo "<label>";
            echo "<p>Select Department: </p>";
            echo "<select name='dept' onchange='findInstructors(this.value); findCourses(this.value);'>";
                echo "<option value=''>Select a Department</option>"; 
                include("loadDepartments.php");
            echo "</select>";
        echo "<div id='instructors'></div>";
        echo "<div id='coursenums'></div>";
        echo "</label>";

        
        /*echo "<label><p>Class Number:</p><select name='course_num' onclick='hide(3)'>";
            echo $course_num;
            echo "<option value=\"324\">324</option>";
            echo "<option value=\"353\">353</option>";
            echo "<option value=\"461\">461</option>";
            echo "<option value=\"480\">480</option>";
            echo "<option value=\"481\">481</option>";
            echo "<option value=\"485\">485</option>";
            echo "<option value=\"490\">490</option>";
            echo "<option value=\"494\">494</option>";
            echo "<option value=\"495\">495</option>";
            echo "<option value=\"594\">594</option>";
            echo "<option value=\"794\">794</option>";
        echo "</select></label>";*/
        
        echo "<label><p>Academic Semester:</p>";
            echo "<select name=\"semester\" onclick=\"hide(1)\">";
            echo $semester;
            echo "<option value=\"Fall\">Fall</option>";
            echo "<option value=\"Winter\">Winter</option>";
            echo "<option value=\"Spring\">Spring</option>";
            echo "<option value=\"Summer\">Summer</option>";
        echo "</select></label>";
        
        echo "<label><p>Academic Year:</p><select name=\"year\" onclick=\"hide(2)\">";
            echo $year;
            echo "<option value=\"2019\">2019</option>";
            echo "<option value=\"2020\">2020</option>";
        echo "</select></label>";
        
        echo "<label><p>Grade Mode:</p><select name=\"mode\" onclick=\"hide(4)\">";
            echo $mode;
            echo "<option value=\"Letter Grades\">Letter Grades</option>";
            echo "<option value=\"Pass/Fail\">Pass/Fail</option>";
        echo "</select></label>";
        
        echo "<input type=\"submit\" value=\"Submit\"></form>";

?>