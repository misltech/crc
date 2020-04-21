<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//echo($_SESSION['user_type']);
if (!isset($_SESSION['id_key'])) {
    header("Location: ../login.php");
}

else if($_SESSION['user_type'] == 'student'){
    //echo("reached student");

    $student_midinitial = $student_phone = $student_address = $student_aptnum = "";
    $student_city = $student_state = $student_zip = "";

    include('db_conn2.php');

    // receive all input values from the form
	
    $student_fname = mysqli_real_escape_string(db, $_POST['firstname']);
    $student_lname = mysqli_real_escape_string($_POST['lastname']);
    $student_midinitial = mysqli_real_escape_string($_POST['middleinitial']);
   $student_phone = mysqli_real_escape_string($_POST['telnum']);
    $student_address = mysqli_real_escape_string($_POST['address']);
    $student_aptnum = mysqli_real_escape_string($_POST['apartmentnumber']);
    $student_city = mysqli_real_escape_string($_POST['city']);
    $student_state = mysqli_real_escape_string($_POST['state']);
   $student_zip = mysqli_real_escape_string($_POST['zipcode']);


    
    // echo( $student_lname);
    // echo($student_midinitial);
    // echo($student_address);
    // echo($student_aptnum);
    // echo($student_city);
    // echo($student_state);
    // echo($student_zip);
    // Check if request is an update otherwise treat as an insert statement

    if ($_POST['query_type'] == 'update'){
        
        $user_email = $_SESSION['id_key'];

        $sql = "UPDATE s20_student_info SET student_first_name = '$student_fname', student_last_name = '$student_lname', student_middle_initial = '$student_midinitial', 
                student_phone = '$student_phone', student_address = '$student_address', student_apt_num = '$student_aptnum', student_city = '$student_city', 
                student_state = '$student_state', student_zip = '$student_zip' WHERE student_email = '$user_email'";
        
        if($conn->query($sql) == true){
            $conn->close();
            // header("Location: ../home.php");
            echo('<script> alert("Done with this")</script');
        }
        else{
            setMessage(false, "Error Updating Profile");
            // header("Location: ../student.php");
            echo('<script> alert("not done")</script');
        }

    } else {
        $user_id = $_SESSION['user_id'];
        $user_email = $_SESSION['id_key'];
            
        // insert values into database
        $sql = "INSERT into s20_student_info (banner_id, student_first_name, student_last_name, student_email, student_middle_initial, student_phone,
                student_address, student_apt_num, student_city, student_state, student_zip)
                VALUES ('$user_id', '$student_fname', '$student_lname', '$user_email', '$student_midinitial',
                '$student_phone', '$student_address', '$student_aptnum', '$student_city', '$student_state', '$student_zip')";

// update user info for future redirects from submit-login.php

            $sql_update = "update s20_UserPass set verified = 1 where email = '$user_email'";

            //echo $sql_update;
            
            if ($conn->query($sql) === true) {
                if ($conn->query($sql_update) === true) {
                    $conn->close();
                    header("Location: ../home.php");
                }
            } 
            else {
                $conn->close();
                header("Location: ../student.php");
            }
        
    }
}
// update so only admin sees var_dump, else redirect to previous page
else{
    $conn->close();
    var_dump($_POST);
}

//include('../skeleton.foot.php');
?>
