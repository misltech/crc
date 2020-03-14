<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("lookupWF");
?>

<div class="modal-header">
    <h1>Search Workflow applications</h1>
</div>

<div class="modal-body" id="searchWF">
    <label>
        <p>Select a project</p>
        <?php
        two_col_drop_down("student_email", "class_number", "s20_application_info");
        ?>
    </label>
</div>

<div class="modal-footer">
    <button onclick="searchWFAJAX();" data-dismiss="modal">Search</button>
</div>


<script>
    function searchWFAJAX() {
        console.log("ajax");
        hideModal();
        let ajaj = new XMLHttpRequest();
        let a = document.getElementById("searchWF").children[0].children[1].value;
        console.log(a);
        ajaj.onreadystatechange = function() {
            console.log(this.readyState + " " + this.status);
            if (this.readyState === 4) {
                if (this.status === 200) {
                    $("#lookupWF").css("display", "none");
                    let json = JSON.parse(this.responseText);
                    if (json == null || json == undefined || (Object.entries(json).length === 0 && json.constructor === Object)) {
                        doModal("Application Not Found", "<p>This Application doesn't exist.</p>");
                    } else {
                        let HTML = 
                            // "<div class=\"content\" style=\"width:100%\">" +
                            // "<table class=\"table list-table\">" + 
                            // "<h2 class=\"table-header\">" + json.appl.name + "</h2>" +

                            // "<tr>" +
                            // "<th > Student Name </td>" +
                            // "<td>" + json.student_info.student_first_name + " " + json.student_info.student_last_name + "</td>" +
                            // "</tr>" +

                            // "<tr>" +
                            // "<th > Student Email </td>" +
                            // "<td>" + json.appl.student_email + "</td>" +
                            // "</tr>" +

                            // "<tr>" +
                            // "<th > Project Name </td>" +
                            // "<td>" + json.appl.name + "</td>" +
                            // "</tr>" +

                            // "<tr>" +
                            // "<th > Semester </td>" +
                            // "<td>" + json.appl.semester + " " + json.appl.year + "</td>" +
                            // "</tr>" +
                            
                            // "<tr>" +
                            // "<th > Department Code </td>" +
                            // "<td>" + json.appl.dept_code + "</td>" +
                            // "</tr>" +

                            // "<tr style=\"border-bottom:1px solid #ddd\">" +
                            // "<th > Assigned to </td>" +
                            // "<td>"+ json.appl.assigned_to + "</td>" +
                            // "</tr>" +

                            // "</table>" +
                            // "</div>";

                            '<p>Course:</p><p>' + json.appl.dept_code + " " + json.appl.class_number  + '</p><p>&nbsp;</p>' +
                            '<p>Student Name:</p><p>' + json.student_info.student_first_name + json.student_info.student_last_name + '</p><p>&nbsp;</p>' +
                            '<p>Student Email:</p><p>' + json.appl.student_email + '</p><p>&nbsp;</p>' +
                            // '<p>Password:</p><p>' + json.passcode + '</p><p>&nbsp;</p>' +
                            '<p>Banner ID:</p><p>' + json.student_info.banner_id + '</p><p>&nbsp;</p>' +
                            '<p>Assigned To:</p><p>' + json.appl.assigned_to + '</p><p>&nbsp;</p>';

                        doModal("Application Information", HTML);
                    }
                }
            }
        }
        ajaj.open("POST", "backend/admin/lookup-WF.php");
        ajaj.send(JSON.stringify({
            "appl": a
        }));
    }
</script>