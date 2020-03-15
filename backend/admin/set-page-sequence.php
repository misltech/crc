<?php

       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include('../util.php');
// This page updates the page sequence in the database

    $formKeys = array('home1', 'student1', 'student2', 'student3', 'student4', 'home2', 'instructor1', 'instructor2',
    'instructor3', 'instructor4', 'instructor5', 'home3', 'employer1', 'home4', 'chair1', 'home5', 'dean1', 'home6',
    'extra1', 'extra2', 'extra3', 'extra4', 'extra5', 'extra6', 'extra7', 'extra8', 'extra9');

    $update = "";

// Loop through POST variables and set values into data array

    foreach ($formKeys as $check) {
        if (isset($_POST[$check])) {
            $data = mysql_real_escape_string($_POST[$check]);
        }
        else {
            $data = "0";
        }
        if ($update != ""){
            $update = $update.", ".$check."='".$data."'";
        }
        else {
            $update = $check."='".$data."'";
            
        }
    }

    $deptKey = mysql_real_escape_string($_POST['dept']);
/*
    echo $columns;
    echo "<hr>";
    echo $values;
*/

// Connect to Database

    include("../db_conn2.php");

// Build MySQL query to update page sequence

    $sql_updateSeq = "UPDATE s20_progress_tracker SET $update where dept_code='$deptKey'";

    if ($conn->query($sql_updateSeq) == True) {
        setMessage(true, "Page Sequence Updated Successfully");
    }
    else {
        setMessage(false, "Unable to Update Page Sequence");
    }
    //header("Location: ../../components/admin/set_page_sequence.php");
    header("Location: ../../admin.php");
    echo $sql_updateSeq;
    $conn->close();

?>