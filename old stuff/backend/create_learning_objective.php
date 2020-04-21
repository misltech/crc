<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once("db_conn2.php");
include_once("util.php");

$lo_title = mysqli_real_escape_string($conn, $_POST['lotitle']);
$lo_desc = mysqli_real_escape_string($conn, $_POST['lodesc']);

$sql_checkMax = "SELECT MAX(LO_id) AS max_id FROM s20_Learning_Obj";
$result = ($conn->query($sql_checkMax))->fetch_assoc();
$next_id = $result['max_id'] + 1;

$sql = "INSERT INTO s20_Learning_Obj (LO_id, LO_title, LO_description) VALUES ('$next_id', '$lo_title', '$lo_desc')";
$result = $conn->query($sql);

if($result) {
    echo $next_id;
}

?>