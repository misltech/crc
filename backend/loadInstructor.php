<?php
session_start();

// check user type here

//connect to database

include('db_conn2.php');

$dept_name = $_GET['dept'];

// Build MySQL statement

$sql = "SELECT email, f_name, l_name from s20_faculty_info where profile_type = 'instructor' and 
		(dept_1 = '$dept_name' OR dept_2 = '$dept_name' OR dept_3 = '$dept_name' OR dept_4 = '$dept_name')";
	
$result = $conn->query($sql);

if ($result->num_rows > 0){
	// create drop down list
	echo "<p>Select Instructor: </p>";
	echo "<select name='instructor'>";

		echo "<option value=''>Select an Instructor</option>"; 

	// Populate options

		while($row = $result->fetch_assoc()){
			
			echo "<option value=".$row['email'].">" .$row['l_name'].", ".$row['f_name']. "</option>"; 
		
		}
	echo "</select>";
	

}
else{
	echo "We have a Problem";
}

$conn->close();

?>