<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('../../backend/util.php');
modalHead("lookupSequence");
?>

<div class="modal-header">
    <h1>View All Workflow applications</h1>
</div>

<div class="modal-body" id="workflowList">
    <!-- <table class="table">
        <thead>
            <tr>
            <th scope="col">Student Name</th>
            <th scope="col">Project Name</th>
            <th scope="col">Semester</th>
            <th scope="col">Department</th>
            <th scope="col">Assigned To</th>
            </tr>
        </thead>

        <tbody> -->


<?php
include("../../backend/db_conn2.php");
echo "testing";

$sqlWF = "SELECT * FROM s20_application_info;";
$resultWF = $conn->query($sqlWF);

if ($resultWF->num_rows > 0) {

    while($appl = $resultWF->fetch_assoc()) {
            // $student_email = $appl["student_email"];

        // $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";
        // $result_student = $conn->query($sql_student);
        // if ($result_student->num_rows > 0){

        //     $result_student = $result_student->fetch_assoc();
        // }
        // echo "<tr>";
        // echo "<th scope=\"row\">".$resultWF["student_email"]."></th>";
        // echo "<td>".$resultWF["name"]."></td>";
        // echo "<td>".$resultWF["semester"]."></td>";
        // echo "<td>".$resultWF["dept_code"]."></td>";
        // echo "<td>".$resultWF["assigned_to"]."></td>";
        // echo "</tr>";
        //echo $appl['student_email'];
        printf("<p>Student email: %s </p>", $appl['student_email']);
        printf("<p>App name: %s </p>", $appl['name']);
    }
}
else {
    echo "0 results";
}

$conn->close();
?>


        <!-- </tbody>
         
    </table> -->

</div>
