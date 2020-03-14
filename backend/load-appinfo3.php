<?php

// Resume existing session

session_start();
include_once('util.php');

// Connect to DB and build MySQL query

$key = $_SESSION['fw_id'];

include_once('db_conn2.php');

$sql = "SELECT * from s20_project_info where fw_id = '$key'";

$result = $conn->query($sql);



if($result->num_rows > 0){
    $result = $result->fetch_assoc();
    $responsibilities = $result['responsibilities'];
    $description = $result['description'];
    $expectation = $result['learning_expectations'];
    $relationship = $result['major_relationship'];
    $background = $result['background'];
    $proposal = $result['proposal'];
    $submit_type = "<input type='hidden' name='submit_type' value='UPDATE'>";
}
else{
    $responsibilities = $description = $expectation = $relationship = $background = $proposal = '';
    $submit_type = "<input type='hidden' name='submit_type' value='INSERT'>";
}



    echo "<form method='post' action='backend/update-appinfo3.php'>";
        echo $submit_type;
        echo "<input type='hidden' name='app_id' value='$key'>";
        echo "<label><p>What are your responsibilities on the site?</p>";
        echo "<textarea name='responsibilities' rows='10' cols='60'>".$responsibilities."</textarea>";
        echo "</label><label><p>What special project will you be working on?</p>";
        echo "<textarea name='description' rows='10' cols='60'>".$description."</textarea>";
        echo "</label><label><p>What do you expect to learn?</p>";
        echo "<textarea name='expectation' rows='10' cols='60'>".$expectation."</textarea>";
        echo "</label><label><p>How is the proposal related to your major areas of interest?</p>";
        echo "<textarea name='relationship' rows='10' cols='60'>".$relationship."</textarea>";
        echo "</label><label><p>Describe the course work you have completed which provides appropriate background to the project.</p>";
        echo "<textarea name='background' rows='10' cols='60'>".$background."</textarea>";
        echo "</label><label><p>What is the proposed method of study? Where appropriate, cite readings and practical experience.</p>";
        echo "<textarea name='proposal' rows='10' cols='60'>".$proposal."</textarea>";
        echo "</label><input type='submit' value='Submit'></form>";

$conn->close();        
?>