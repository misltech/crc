<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container">
    <div class=" justify-content-center mt-5">
        <h6 class="text-center">Assignable page!</h6>
        <p class="text-center">
            This page should show all users registered using s20_userpass table.
            <p class="text-center">2. Have the ability to see courses available using s20_course_numbers</p>
            <p class="text-center">3. Assign a faculty to a course. Using s20_faculty_info. Where they will be assigned to a course using the s20_course_number id</p>
            <p class="text-center">This was the easiest way. This bypassed the complicated project students made the previous semester. I hope this help future developers!</p>
            <p class="text-center">//Sample query is SELECT * FROM s20_faculty_info WHERE s20_faculty_info.classes IN (SELECT id FROM s20_course_numbers WHERE dept_code='$dept' AND course_number = '$course'</p>
            <p class="text-center">I used this in editcourses.php . This allows you to select rows from s20_faculty info where the in the faculty table its like this (1,2) meaning they are assigned to id 1 and 2.</p>

        </p>
    </div>
</div>
<?php
include_once('components/footer.php');
?>