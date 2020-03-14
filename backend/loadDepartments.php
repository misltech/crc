<?php

// resume session

//session_start();

// check user type

// open DB connection

include("db_conn2.php");

// set up db query

$sql = "SELECT dept_code, name from s20_academic_dept_info";

$result = $conn->query($sql);

// check if query returned values and create loop

if ($result->num_rows > 0){

// create drop down list
/*
	echo "<p>Select Department: </p>";
	echo "<select name='dept' onchange='findInstructors(this.value)'>";

		echo "<option value=''>Select a Department</option>"; 
*/
// Populate options

		while($row = $result->fetch_assoc()){
			
			echo "<option value=".$row['dept_code']." id=".$row['dept_code'].">" .$row['name']. "</option>"; 
		
		}
//	echo "</select>";
}
	
else{
	
	echo "We had a problem";
}

$conn->close();	

?>

<script>

// function for AJAX request for instructors associated with given academic department

	function findInstructors(str){
		var xhttp;
		if (str == ''){
			document.getElementById("instructors").innerHTML = "";
			return;
		}
		else{
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("instructors").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "backend/loadInstructor.php?dept="+str, true);
			xhttp.send();
		
		}
	}
</script>