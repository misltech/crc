<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("createDept");
?>
<div class="modal-header">
    <h1>Create Department</h1>
</div>
<form action="backend/admin/create-department.php" method="post">
    <label>
        <p>What is the department name?</p>
        <input type="text" name="deptName" />
    </label>
    <label>
        <p>What is the department code?</p>
        <input type="text" name="deptCode" />
    </label>
    <label>
        <p>Enter the department dean's email:</p>
        <input type="text" name="deanEmail"/>
        <?php
        //drop_down_conditional("email", "s20_UserPass", "profile_type = 'dean'");
        ?>
    </label>
    <label>
        <p>Enter the department chair's email:</p>
        <input type="text" name="chairEmail"/>
        <?php
        //drop_down_conditional("email", "s20_UserPass", "profile_type= 'chair'");
        ?>
    </label>
    <hr />
    <h2>Permissions</h2>
    <?php
    checkBox("Instructor can modify course info.", "ins_course", false);
    checkBox("Instructor can modify project info.", "ins_proj", false);
    checkBox("Instructor can modify employer info.", "ins_emp", false);
    checkBox("Employer can modify project info.", "emp_proj", false);
    checkBox("Employer can modify learning objectives.", "emp_learn", false);
    checkBox("Department chair can modify course information.", "ch_course", true);
    checkBox("Department chair can modify project information.", "ch_proj", true);
    checkBox("Department chair can modify employer information.", "ch_emp", true);
    checkBox("Department chair can modify learning objectives.", "ch_learn", true);
    checkBox("Dean can modify course info.", "dean_course", true);
    checkBox("Dean can modify project information.", "dean_proj", true);
    checkBox("Dean can modify employer information.", "dean_emp", true);
    checkBox("Dean can modify learning objectives.", "dean_learn", true);
    ?>
    <h2>E-mail Settings</h2>
    <?php 
    checkBox("Students get e-mails sent to them with updates.", "stu_send", true);
    checkBox("Students get reminder e-mails.", "stu_rem", true);
    checkBox("Instructors get e-mails sent to them with updates.", "inst_send", true);
    checkBox("Instructors get rejection e-mails.", "inst_rej", true);
    checkBox("Instructors get reminder e-mails.", "inst_rem", true);
    checkBox("Employers get e-mails sent to them with updates.", "emp_send", true);
    checkBox("Employers get rejection e-mails.", "emp_rej", true);
    checkBox("Employers get reminder e-mails.", "emp_rem", true);
    checkBox("Department chair gets updates sent to them.", "chair_send", true);
    checkBox("Department chair gets rejection e-mails.", "chair_rej", true);
    checkBox("Department chair gets reminder e-mails sent to them.", "chair_rem", true);
    checkBox("Dean gets update e-mails.", "dean_send", true);
    checkBox("Dean gets rejection e-mails.", "dean_rej", true);
    checkBox("Dean gets reminder e-mails.", "dean_rem", true);
    ?>
    <input type="submit" value="Create">
</form>
<?php
include('component_template.foot.php');

?>