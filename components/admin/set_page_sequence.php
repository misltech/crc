<?php

include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("lookupSequence");

//include('../../skeleton.head.php'); 
?>
    <div class="modal-header">
        <h1>Set Page Sequence</h1>
    </div>
    <form action="backend/admin/set-page-sequence.php" method="post">
        <?php
            echo "<select name='dept' onchange='loadSequence(this.value)'>";
                echo "<option selected disabled hidden>Select a Department</option>"; 
                    include("backend/loadDepartments.php");
            echo "</select>";
        ?>
    <div id="pageSequence"></div>
    </form>
<?php
//include('skeleton.foot.php'); 
include('component_template.foot.php');
?>
<script>
    function loadSequence(dept) {
        var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("pageSequence").innerHTML = this.responseText;
//                    update(document.getElementById("seq_1").value, 1);
                }
			};
			xmlhttp.open("GET", "load-page-sequence.php?key=" + dept, true);
			xmlhttp.send();
    }

    
	var zFlag = 0;
    
	function update(test, id) {
		
    var sum = 0;
    var checkSum = 0;
    var lower = true;
    var zeroCount = 0;
    var id = parseInt(id);
    var length = document.getElementById("seq_1").length-1;
    
    console.log(length);
    
    
    for (i = 1; i <= length - zFlag; i++) {
        var value = parseInt(document.getElementById("seq_"+i).value);
        sum = sum + i;
    }
    
    for (i = 1; i <= length; i++) {
        var value = parseInt(document.getElementById("seq_"+i).value);

            checkSum = checkSum + value;

    }

    if (sum < checkSum) {
        lower = false;
    }

    if (lower) {
        var replacement = sum - checkSum;
//			console.log(parseInt(test) + replacement - 1); 
//			console.log(replacement);
    }
    else {
        var replacement = checkSum - sum;

    }
//console.log(lower);
//console.log(replacement);
//console.log(zFlag);
// Adjust select options to push values up or down depending on selected option
        
    for (i = 1; i <= length; i++) {
        
        var value = parseInt(document.getElementById("seq_"+i).value);
        if (value == 0){
            zeroCount++;
        }
        if (i != id) {			
            if (lower){
                if (parseInt(test) == 0 && value >= replacement) {
                    value--;
                    document.getElementById("seq_"+i).value = value.toString();
                }
                if (value >= parseInt(test) && value <= (parseInt(test) + replacement - 1) && parseInt(test) != 0) {
                    value++;
                    document.getElementById("seq_"+i).value = value.toString();
                }
            }
            else {
                if (zFlag > 0 && value >= parseInt(test)-replacement && value < parseInt(test)+replacement && parseInt(test) != replacement) {
                    value--;
                    document.getElementById("seq_"+i).value = value.toString();
                }
                if (zFlag > 0 && parseInt(test) == replacement && value >=parseInt(test)) {
                    value++;
                    document.getElementById("seq_"+i).value = value.toString();
                }
                if (value <= parseInt(test) && value >= (parseInt(test) - replacement) && value != 0 && zFlag < 1) {
                    value--;
                    document.getElementById("seq_"+i).value = value.toString();
                }
            }
        }
    }
    zFlag = zeroCount;
    var tempLength = length - zFlag;
//		console.log(tempLength);
    
// if test value equals 0 then loop through all select elements and remove		

    for (i = 1; i <=length; i++) {
        var value = parseInt(document.getElementById("seq_"+i).value);

        
        for (j = 1; j <= length; j++){
            var optionChk = document.getElementById("seq_"+i).options[j].value;
            if (lower) {	
                if (optionChk >= tempLength) {
                    if (zFlag > 0){
                        if (value == 0 && optionChk-tempLength-1 > 0){
                            document.getElementById("seq_"+i).options[j].style.display = "none";
                        }
                        if (value != 0 && optionChk > tempLength){
                            document.getElementById("seq_"+i).options[j].style.display = "none";
                        }
                    }
                }
            }
            else {
                if (value == 0 && optionChk <= tempLength+1) {
                    document.getElementById("seq_"+i).options[j].style.display = "block";
                }
                if (value != 0 && optionChk <= tempLength) {
                    document.getElementById("seq_"+i).options[j].style.display = "block";
                }
            }

        }
    }

// console.log(zFlag);		
}
</script>