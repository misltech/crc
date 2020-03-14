<?php 

session_start();
include('skeleton.head.php');

echo "<h2> Profile Information </h2><br>";

echo "<div id='profile'></div>";

include('skeleton.foot.php'); 

?>

<script>
 
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            document.getElementById("profile").innerHTML = this.responseText;
            
            
		}
	};
	xhttp.open("GET", "backend/load-faculty.php", true);
    xhttp.send();

    function showDept2(){
        document.getElementById("Dept2").style.display = 'block';
    }
    function showDept3(){
        document.getElementById("Dept3").style.display = 'block';
    }
    function showDept4(){
        document.getElementById("Dept4").style.display = 'block';
    }

    function hide1(){
        document.getElementById("dept_1").style.display = 'none';
    }
    function hide2(){
        document.getElementById("dept_2").style.display = 'none';
    }
    function hide3(){
        document.getElementById("dept_3").style.display = 'none';
    }
    function hide4(){
        document.getElementById("dept_4").style.display = 'none';
    }

</script>
