<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("lookupDept");
?>
<div class="modal-header">
    <h1>Look Up Department</h1>
</div>
<div class="modal-body" id="searchDeptForm">
    <label>
        <p>Select a department.</p>
        <?php
        drop_down("name", "s20_academic_dept_info");
        ?>
    </label>
</div>
<div class="modal-footer">
    <button onclick="searchDeptAJAX();" data-dismiss="modal">Search</button>
</div>
<script>
    function searchDeptAJAX() {
        hideModal();
        let ajaj = new XMLHttpRequest();
        let d = document.getElementById("searchDeptForm").children[0].children[1].value;
        ajaj.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    $("#lookupDept").css("display", "none");
                    let json = JSON.parse(this.responseText);
                    if (json == null || json == undefined || (Object.entries(json).length === 0 && json.constructor === Object)) {
                        doModal("Department Not Found", "<p>This department doesn't exist.</p>");
                    } else {
                        let editPermissionsWorks = false;
                        let emailPermissionsWorks = false;
                        try {
                            delete json.edit_permssions.dept_code;
                            editPermissionsWorks = true;
                        } catch (err) {
                            ;
                        }
                        try {
                            delete json.email_permssions.dept_code;
                            emailPermissionsWorks = true;
                        } catch (err) {
                            ;
                        }
                        console.log(json);
                        let HTML =
                            "<form action='backend/admin/modify-dept.php' method='post'>" +
                            "<label><p>Department name:</p><input type='text' name='deptName' value='" + json.dept.name + "'></label>" +
                            "<label><p>Department code:</p><input type='text' name='deptCode' value='" + json.dept.dept_code + "'></label>" +
                            "<label><p>Department chair's e-mail:</p><input type='email' name='chair' value='" + json.dept.chair_email + "'></label>" +
                            "<label><p>Department dean's e-mail:</p><input type='email' name='dean' value='" + json.dept.dean_email + "'></label></form>";
                        if (editPermissionsWorks) {
                            HTML +=
                                "<h2>Editing Permssions</h2>" +
                                "<p>This section changes who can edit what. Checking a box means that particular party has that permission.</p>" +
                                "<form method='post' action='backend/admin/modify-dept-edit-permissions.php'>" +
                                "<input type='hidden' name='deptCode' value='" + json.dept.dept_code + "' />";
                            let nicerEditPermissions = {
                                'instructor_course': "Instructors may change course information.",
                                'instructor_project': "Instructors may change project information.",
                                'instructor_emp': "Instructors may change employer information.",
                                'emp_project': "Employers may change project information.",
                                'emp_learning': "Employers may change learning objectives.",
                                'chair_course': "Department chair may change course information.",
                                'chair_project': "Department chair may change project information.",
                                'chair_emp': "Department chair may change employer information.",
                                'chair_learning': "Department chair may change learning objectives.",
                                'dean_course': "Dean may change course information.",
                                'dean_project': "Dean may change project information.",
                                'dean_emp': "Dean may change employer information.",
                                'dean_learning': "Dean may change learning objectives."
                            }
                            for (value in json.edit_permssions) {
                                HTML += "<p><label style='text-align: left;'><input type='checkbox' name='" + value + "' " + (json.edit_permssions[value] == 1 ? "checked" : "") +
                                    " >" + nicerEditPermissions[value] + "</label></p>";
                            }
                            HTML += "</table><input type='submit' value='Change Permissions'></form>";
                        } else {
                            HTML += "<h2>Editing Permissions</h2>"
                            HTML += "<p>Editing permissions are not correctly set up. Please, try deleting the department" +
                                "from the database (using the button below) and creating it again.</p>"
                        }
                        HTML += "<hr />";
                        if (emailPermissionsWorks) {
                            HTML +=
                                "<h2>E-mail Preferences</h2>" +
                                "<p>This section writes about who can receive what e-mails. Checking a box will allow for that type of e-mail to be sent to that person, whereas unchecking does the opposite.</p>" +
                                "<form method='post' action='backend/admin/modify-dept-email-permissions.php'>" +
                                "<input type='hidden' name='deptCode' value='" + json.dept.dept_code + "' />";
                            let nicerEmailPermissions = {
                                'student_send': "Students will get updates.",
                                'student_remind': "Students will get reminder e-mails.",
                                'instructor_send': "Instructors will get updates.",
                                'instructor_remind': "Instructors will get reminder e-mails.",
                                'instructor_reject': "Instructors will get rejection notifications.",
                                'employer_send': "Employers will get updates.",
                                'employer_reject': "Employers will get rejection notifications.",
                                'employer_remind': "Employers will get reminder notifications.",
                                'chair_send': "Department chair will get updates.",
                                'chair_reject': "Department chair will get rejection notifications.",
                                'chair_remind': "Department chair will get reminder notifications.",
                                'dean_send': "Dean will get updates.",
                                'dean_reject': "Dean will get rejection e-mails.",
                                'dean_remind': "Dean will get reminder e-mails."
                            }
                            for (value in json.email_permssions) {
                                HTML += "<p><label style='text-align: left;'><input type='checkbox' name='" + value + "' " + (json.email_permssions[value] == 1 ? "checked" : "") +
                                    " >" + nicerEmailPermissions[value] + "</label></p>";
                            }
                            HTML += "</table><input type='submit' value='Change Preferences'></form>";
                        } else {
                            HTML += "<h2>E-mail Preferences</h2>"
                            HTML += "<p>E-mail preferences are not correctly set up. Please, try deleting the department" +
                                "from the database (using the button below) and creating it again.</p>"
                        }
                        HTML += "<form action='backend/admin/delete-department.php' method='post'>";
                        HTML += "<input type='hidden' name='deptCode' value='" + json.dept.dept_code + "' />";
                        HTML += "<p>Please don't click this button unless you are VERY, VERY sure.</p>";
                        HTML += "<button class='btn-danger'>Remove Department</button>";
                        HTML += "</form>"
                        doModal("Department Information", HTML);
                    }
                }
            }
        }
        ajaj.open("POST", "backend/admin/lookup-department.php");
        ajaj.send(JSON.stringify({
            "dept": d
        }));
    }
</script>
<?php
include('component_template.foot.php');

?>