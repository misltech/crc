<?php

// Resume Existing Session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$_SESSION['page_key'] = "student3";

include('skeleton.head.php');

    echo "<h1>Fieldwork Application:</h1><br>";
    echo "<h3>Project Information</h3>";
    echo "<div id='project_info'></div>";

include('skeleton.foot.php');

?>

<script>
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            document.getElementById("project_info").innerHTML = this.responseText;  
		}
	};
	xhttp.open("GET", "backend/load-appinfo3.php", true);
    xhttp.send();
</script>
