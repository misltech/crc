<?php

// Resume existing session

session_start();

include_once('util.php');
include_once('db_conn2.php');
// Check if user is a student

//checkUserType('student');

// Get all variables from post request

    $resp = mysqli_real_escape_string($conn, $_POST['responsibilities']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $expect = mysqli_real_escape_string($conn, $_POST['expectation']);
    $relation = mysqli_real_escape_string($conn, $_POST['relationship']);
    $back = mysqli_real_escape_string($conn, $_POST['background']);
    $prop = mysqli_real_escape_string($conn, $_POST['proposal']);
    $sub_type = mysqli_real_escape_string($conn, $_POST['submit_type']);
    $id = $_SESSION['fw_id'];

// Connect to DB and build MySQL query



if($sub_type == "INSERT"){

    $sql = "INSERT INTO s20_project_info (fw_id, responsibilities, description, learning_expectations,
            major_relationship, background, proposal) VALUES ('$id', '$resp', '$desc', '$expect',
            '$relation', '$back', '$prop')";

}
else{

    $sql = "UPDATE s20_project_info SET responsibilities='$resp', description='$desc', learning_expectations='$expect',
            major_relationship='$relation', background='$back', proposal='$prop' WHERE fw_id='$id'";

}

if($conn->query($sql) == True){
    setMessage(true, "Application updated successfully");
    if (isset($_SESSION['edit_return'])) {
        $redirect = $_SESSION['edit_return'];
        header("Location: ../".$redirect."");
    }
    else {
        header("Location: sequence-controller");
    }
}
else{
    setMessage(false, "Failed to update Application");
    var_dump($_POST);
    echo "<br><br>";
    //echo $sql;
    //header("Location: ../student-application3.php");
}


$conn->close();
?>

