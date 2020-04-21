<?php

include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("lookupSequence");

//include('../../skeleton.head.php'); 
?>

    <div class="modal-header">
        <h1>Lookup Course</h1>
    </div>
    <div class="modal-body" id="searchDeptForm">
        <label>
            <p>Select a department:</p>
            <?php
                drop_down("name", "s20_academic_dept_info");
            ?>
        </label>
    </div>
    <div class="modal-footer">
        <button onclick="loadSequence();" data-dismiss="modal">Search</button>
    </div>
    <script>
        function loadSequence() {
            hideModal();
            let xmlhttp = new XMLHttpRequest();
            let targetDept = document.getElementById("searchDeptForm").children[0].children[1].value;
            console.log(targetDept);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log('Response received');
                    //$("#lookupSequence").css("display", "none");
                    doModal("Edit Course Sequence", this.responseText);
                }
            }
            xmlhttp.open("GET", "components/admin/new-load-page-sequence.php?key=" + targetDept, true);
            xmlhttp.send();
        }
    </script>

    <?php
    include('component_template.foot.php');
    ?>