<?php

// Resume Session
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('backend/util.php');
include('skeleton.head.php');

//check user type 

//checkUserType('student');

// declare variables from GET request

$applicationID = $_SESSION['fw_id'];
if (!isset($_SESSION['edit_mode'])){
	$_SESSION['fw_id'] = $applicationID;
}

// Set page key

	$_SESSION['page_key'] = "student1";

include('backend/db_conn2.php');

	$sql = "SELECT dept_code from s20_application_info where fw_id='$applicationID'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$result = $result->fetch_assoc();
		$_SESSION['dept'] = $result['dept_code'];
	}

echo "<h1>Fieldwork Application:</h1><br>";
echo "<h3>Course Information</h3>";

// Build Fieldwork form below

echo "<div id='app_info'></div>";
echo "<button onclick=\"window.location = 'student-application1.php';\">Back</button>";

//include('backend/load-appinfo1.php');

include('skeleton.foot.php');
?>
<script>
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            document.getElementById("app_info").innerHTML = this.responseText;    
		}
	};
	xhttp.open("GET", "backend/load-appinfo1.php", true);
    xhttp.send();

    function hide(elementID){
        document.getElementById(elementID).style.display = 'none';
    }
</script>
