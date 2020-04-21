<?php

// Resume Existing Session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('util.php');

// get session variables

$fw_id = $_SESSION['fw_id'];
$dept = $_SESSION['dept'];

// get variables from POST request

$learning_objectives = [];
$update_ids = [];

for($x = 1; $x < 9; $x++) {
    $lo_count = "LO".$x;
    $lo_ID = $lo_count."_id";

    if ($_POST[$lo_count] != "") {
        $learning_objectives[] = $_POST[$lo_count];
    }
    
// Check if $lo_id exists    

    if (isset($_POST[$lo_ID])) {
        $update_ids[] = $_POST[$lo_ID];
    }
}

// Connect to DB and build MySQL query

    include('db_conn2.php');

    $index = 0;

    foreach ($update_ids as $update) {
        $desc = mysqli_real_escape_string($conn, $learning_objectives[$index]);
        
        $sql_update = "UPDATE s20_Learning_Objectives SET description='$desc' WHERE lo_id=$update";
        $index++;
        
        if ($conn->query($sql_update) != True) {
            echo "We Have a Problem - UPDATE<br><br>";
        }
    
    }

    for ($index; $index < count($learning_objectives); $index++) {
        $desc = mysqli_real_escape_string($conn, $learning_objectives[$index]);
        $sql_insert =   "INSERT INTO s20_Learning_Objectives (fw_id, dept_code, description) VALUES
                        ('$fw_id', '$dept', '$desc')";
        //echo $sql_insert."<br><br>";
        $conn->query($sql_insert);
    }

    $conn->close();

    if (isset ($_SESSION['edit_return']) == True) {
        $redirect = $_SESSION['edit_return'];
        header("Location: ../".$redirect."");
    }
    else {
        header("Location: sequence-controller.php");
    }
?>