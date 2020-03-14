<?php
session_start();

include_once('util.php');
include_once('db_conn2.php');

$dept_name = $_POST['dept'];

// Build MySQL statement

$sql = "SELECT course_num from s20_course_numbers where dept_code = '$dept_name'";
	
$result = $conn->query($sql);

if ($result->num_rows > 0){
	// create drop down list
	echo "<p>Select Course Number: </p>";
	echo "<select name='course_num'>";

		echo "<option value=''>Select an Instructor</option>"; 

	// Populate options

		while($row = $result->fetch_assoc()){
			
			echo "<option value=".$row['course_num'].">" .$row['course_num']."</option>"; 
		
		}
	echo "</select>";
	

}
else{
	echo "We have a Problem";
}

$conn->close();

?>