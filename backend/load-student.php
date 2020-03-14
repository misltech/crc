<?php

// Resume existing session

session_start();
include('util.php');

// Check user type for student

//checkUserType('student');

// Pull id_key from Session

$search_key = $_SESSION['id_key'];

// Connect to DB and build MySQL query

include('db_conn2.php');

$sql = "SELECT * from s20_student_info where student_email='$search_key'";

$profile_info = $conn->query($sql);

if($profile_info->num_rows >0){
    setMessage(true, 'User Data Found');
    $profile_info = $profile_info->fetch_assoc();

    echo "<form id='profile' method='post' action='backend/submit-student.php'>";

        echo "<input type='hidden' name='query_type' value='update'>";

        echo "<label><p>First Name:</p>";
        echo "<input type='text' name='firstname' value='".$profile_info['student_first_name']."'></label>";

        echo "<label><p>Last Name:</p>";
        echo "<input type='text' name='lastname' value='".$profile_info['student_last_name']."'></label>";

        echo "<label><p>Middle Initial:</p>";
        echo "<input type='text' name='middleinitial' value='".$profile_info['student_middle_initial']."'></label>";

        echo "<label><p>Phone Number:</p>";
        echo "<input type='text' name='telnum' value='".$profile_info['student_phone']."'></label>";

        echo "<label><p>Address:</p>";
        echo "<input type='text' name='address' value='".$profile_info['student_address']."'></label>";

        echo "<label><p>Apartment Number:</p>";
        echo "<input type='text' name='apartmentnumber' value='".$profile_info['student_apt_num']."'></label>";

        echo "<label><p>City:</p>";
        echo "<input type='text' name='city' value='".$profile_info['student_city']."'></label>";

        echo "<label><p>State:</p>";
        include('../components/state_dropdown.php'); 
        echo "</label>";

        echo "<label><p>Zipcode:</p>";
        echo "<input type='text' name='zipcode' value='".$profile_info['student_zip']."'></label>";

        echo "<input type='submit' value='Submit'>";

    echo "</form>";
}
else {
    setMessage(false, 'No Data Found');

    echo "<form id='profile' method='post' action='backend/submit-student.php'>";

        echo "<input type='hidden' name='query_type' value='insert'>";

        echo "<label><p>First Name:</p>";
        echo "<input type='text' name='firstname'></label>";

        echo "<label><p>Last Name:</p>";
        echo "<input type='text' name='lastname'></label>";

        echo "<label><p>Middle Initial:</p>";
        echo "<input type='text' name='middleinitial'></label>";

        echo "<label><p>Phone Number:</p>";
        echo "<input type='text' name='telnum'></label>";

        echo "<label><p>Address:</p>";
        echo "<input type='text' name='address'></label>";

        echo "<label><p>Apartment Number:</p>";
        echo "<input type='text' name='apartmentnumber'></label>";

        echo "<label><p>City:</p>";
        echo "<input type='text' name='student_city'></label>";

        echo "<label><p>State:</p>";
        include('../components/state_dropdown.php'); 
        echo "</label>";

        echo "<label><p>Zipcode:</p>";
        echo "<input type='text' name='zipcode'></label>";

        echo "<input type='submit' value='Submit'>";

    echo "</form>";
}

$conn->close();

?>
