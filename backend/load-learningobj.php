<?php

// Resume exisiting session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$searchKey = $_SESSION['fw_id'];

// Connect to DB and query learning_objectives table using searchKey param

include('db_conn2.php');

$sql = "SELECT * from s20_Learning_Objectives WHERE fw_id='$searchKey' ORDER BY lo_id";

$result = $conn->query($sql);

// Set variable as counter to allow up to 8 learning objectives

$lo_count = 1;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $title = "Learning Objective #".$lo_count.":";
        $id_tag = "LO".$lo_count;
        $hidden_id = $id_tag."_id";
        $display = "style='display: block'";

        echo "<div id='".$id_tag."' ".$display."><label><p>".$title."</p>";

        echo "<textarea name='".$id_tag."' rows='5' cols='60'>".$row['description']."</textarea>";

        echo "<input type='hidden' name='".$hidden_id."' value='".$row['lo_id']."'>";

        echo "</label></div>";

        $lo_count++;
    }

}

$currentCount = $lo_count;

for ($lo_count; $lo_count < 9; $lo_count++) {

    $title = "Learning Objective #".$lo_count.":";
    $id_tag = "LO".$lo_count;
    $display = "style='display: none'";

    if ($lo_count == $currentCount){

        $display = "style='display: block'";

    }
    
    echo "<div id='".$id_tag."' ".$display."><label><p>".$title."</p>";

    echo "<textarea name='".$id_tag."' rows='5' cols='60'></textarea>";

    echo "</label></div>";

}



$conn->close();

?>