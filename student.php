<?php 
session_start();
include('backend/util.php');
//checkUserType("student");

include('skeleton.head.php'); 

echo "<h2>Student Information</h2>";
echo "<div id='profile'></div>";

include('skeleton.foot.php'); 
?>

<script>
			xhttp = new XMLHttpRequest();
			xhttp.onload = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("profile").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "backend/load-student.php", true);
			xhttp.send();
</script>
