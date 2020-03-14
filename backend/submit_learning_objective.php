<?php

session_start();

include_once("db_conn2.php");
include_once("util.php");

$fw_id = $_SESSION['fw_id'];

$lo_string = mysqli_real_escape_string($conn, $_POST['loids']);

$sql = "UPDATE s20_application_info SET learning_obj='$lo_string' WHERE fw_id='$fw_id'";
$result = $conn->query($sql);

if ($result){
    $conn->close();
    header("Location: sequence-controller.php");
}

?>