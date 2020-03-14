<?php

session_start();

include_once("skeleton-fluid.head.php");
include_once("backend/util.php");

//$_SESSION['fw_id'] = '20';

?>

<h1>Plan and Review Learning Objectives</h1>
<div id=dataRow class=row>
    <div id=defaultLO class="col-md-6 dragTarget buttonHolder" ondrop=drop(event) ondragover=allowDrop(event)>
        <h2>Available Learning Objectives</h2>
        <h3>Click and drag orange buttons to the right side to add learning objectives!</h3>
    </div>
    <div id=selectedLO class="col-md-6 dragTarget buttonHolder" ondrop=drop(event) ondragover=allowDrop(event)>
        <h2>Selected Learning Objectives</h2>
        <h3>To make a custom learning objective, use this form:</h3>
            <form id=customLOForm action="#">
                <textarea rows='1' cols='50' id=loTitle placeholder="Enter Learning Objective Title" required></textarea>
                <textarea rows='2' cols='50' id=loDescription placeholder="Describe Learning Objective" required></textarea>
                <input type="submit" value="Add To Workflow" class="btn btn-primary"onclick="createNewLO()">
            </form>
        <h3>Drag orange buttons here to add learning objectives!</h3> 
    </div>
</div>

<input type=submit value="Save Learning Objectives" onclick="submitLO()">
<div id="<?php echo $_SESSION['page_key']; ?>"></div>

<?php
include_once("skeleton.foot.php");
?>

<script>

loadUserLO()
loadDefaultLO();

const API_URL = "<?php echo API_URL; ?>";

function loadDefaultLO(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("defaultLO").innerHTML += this.responseText;
        }
    };
	xmlhttp.open("GET", "backend/load-learning-objective.php");
	xmlhttp.send();
}

function loadUserLO(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("selectedLO").innerHTML += this.responseText;
        }
    };
	xmlhttp.open("POST", "backend/load-learning-objective.php");
	xmlhttp.send();
}

function createNewLO(){
    //retrieve and reset LO information
    const lo_title = document.getElementById("loTitle").value;
    const lo_description = document.getElementById("loDescription").value;

    document.getElementById("loTitle").value = '';
    document.getElementById("loDescription").value = '';

    var xmlhttp = new XMLHttpRequest();
    const parameters = "lotitle="+lo_title+"&lodesc="+lo_description;

    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            var lo_HTML = "<div id=LO"+this.responseText+" class='col-md-6 loButton' draggable=true ondragstart=drag(event)><b>" +
                lo_title + "</b><br>" + lo_description + "</div>";

            document.getElementById("selectedLO").innerHTML += lo_HTML;
        }
    };
	xmlhttp.open("POST", "backend/create_learning_objective.php");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(parameters);
}

function submitLO(){
    var all_los = document.getElementsByClassName("loButton");
    var selected_los = [];
    for (var i = 0; i < all_los.length; i++){
        if (all_los[i].parentElement.id == "selectedLO"){
            selected_los.push(all_los[i].id.slice(2));
        }
    }
    const lo_id_string = selected_los.join();
    
    var xmlhttp = new XMLHttpRequest();
    const parameters = "loids="+lo_id_string;
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
            //console.log(API_URL + 'backend/sequence-controller.php');
            window.location.href = (API_URL + 'backend/sequence-controller.php');
        }
    };
	xmlhttp.open("POST", "backend/submit_learning_objective.php");
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
    if (ev.target.classList.contains('dragTarget')){
        ev.target.appendChild(document.getElementById(data));
    } else if (ev.target.parentNode.classList.contains('dragTarget')) {
        ev.target.parentNode.appendChild(document.getElementById(data));
    }
}

function allowDrop(ev){
	ev.preventDefault();
}
</script>