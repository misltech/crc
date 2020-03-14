<?php

session_start();

include_once("db_conn2.php");
include_once("util.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
//For GET requests only the 10 default learning objectives are displayed
//this will typically only be run AFTER the POST block is run
    $sql = "SELECT * FROM s20_Learning_Obj WHERE LO_id < 11";
    $result = $conn->query($sql);

    //get ids of already used learning objectives
    $fw_id = $_SESSION['fw_id'];
    $lo_sql = "SELECT learning_obj FROM s20_application_info WHERE fw_id='$fw_id'";
    $lo_result = ($conn->query($lo_sql))->fetch_assoc();
    $lo_array = explode(',', $lo_result['learning_obj']);

    if ($result->num_rows > 0){
        $i = 1;
        while ($row = $result->fetch_assoc()){
            //if a learning objective has already been used, omit it and move on
            if (in_array($i, $lo_array)){
                $i++;
            } else {
                echo "<div id=LO".$i." class=\"col-md-6 loButton\" draggable=true ondragstart=drag(event)>";
                echo "<b>".$row['LO_title']."</b><br>";
                echo $row['LO_description']."</div>";
                $i++;
            }
        }

    } else {
        echo "Error";
    }
} else if ($method == 'POST') {
//for POST requests any LOs already attached to the application are displayed
    $fw_id = $_SESSION['fw_id'];
    $sql = "SELECT learning_obj FROM s20_application_info WHERE fw_id='$fw_id'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();
    if ($result['learning_obj'] == null){
        //echo "null error";
    } else {
        $lo_ids = explode(',', $result['learning_obj']);
        foreach ($lo_ids as $val){
            $sql = "SELECT * FROM s20_Learning_Obj WHERE LO_id=$val";
            $result = ($conn->query($sql))->fetch_assoc();
            echo "<div id=LO".$val." class=\"col-md-6 loButton\" draggable=true ondragstart=drag(event)>";
            echo "<b>".$result['LO_title']."</b><br>";
            echo $result['LO_description']."</div>";
        }
    }
}
?>