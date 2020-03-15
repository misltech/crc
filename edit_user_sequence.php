<?php
/*
include_once('component_template.head.php');


modalHead("setUser");
*/
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include_once('components/drop_down.php');
include('skeleton.head.php'); 
include_once('backend/util.php');
?>
<style>

</style>


<div class="modal-header">
    <h1>Change Workflow Order</h1>
	
</div>
<form action="backend/admin/set-user-sequence.php" method="post">
    <?php
        echo "<select id='deptselect' name='dept' onchange='findCourses(this.value)'>";
            echo "<option selected disabled hidden>Select a Department</option>"; 
                    include("backend/loadDepartments.php");
			echo "</select>";
			echo "<div id=coursenums></div>";
//        include("../../backend/loadDepartments.php");
    ?>
	<h3>
		To change Workflow Order <b>click and drag orange buttons from the left side to the right side</b>.<br>
		Any steps remaining on the left side will NOT be included in the new Workflow Order.
	</h3>
    <div id="userSequence"></div>
</form>
<?php
include('skeleton.foot.php'); 
//include('component_template.foot.php');
?>
<script>

    function loadSequence() {
		const dept = document.getElementById('deptselect').value;
        var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("userSequence").innerHTML = this.responseText;
//                    update(document.getElementById("seq_1").value, 1);
                }
			};
			xmlhttp.open("GET", "backend/admin/load-user-sequence.php?key=" + dept, true);
			xmlhttp.send();
    }

	function findCourses(str){
        const parameters = "dept="+str;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("coursenums").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "backend/load-course-numbers-seq.php");
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(parameters);
    }

	function drag(ev){
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev){
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		//prevents buttons from nesting in each other
		//also prevents multiple buttons from being placed in one step
    	if (ev.target.classList.contains('dragTarget') && ev.target.childElementCount < 1){
        	ev.target.appendChild(document.getElementById(data));
    	} else if (ev.target.parentNode.classList.contains('dragTarget') && ev.target.parentNode.childElementCount < 1) {
        	ev.target.parentNode.appendChild(document.getElementById(data));
    	}
	}

	function allowDrop(ev){
		ev.preventDefault();
	}

</script>