<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("viewAllWF");
?>

<div class="modal-header">
    <h1>View All Workflow applications</h1>
</div>

<div class="modal-body" id="workflowList">
    <!-- <table class="table list-table"> -->
        <!-- <thead>
            <tr>
            <th scope="col">Student Name</th>
            <th scope="col">Project Name</th>
            <th scope="col">Semester</th>
            <th scope="col">Department</th>
            <th scope="col">Assigned To</th>
            </tr>
        </thead> -->

        <!-- <tbody> -->


<?php
include("backend/db_conn2.php");

$sqlWF = "SELECT * FROM s20_application_info";
$resultWF = $conn->query($sqlWF);

if ($resultWF->num_rows > 0) {
    while($appl = $resultWF->fetch_assoc()){
        $student_email = $appl["student_email"];

        $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";
        $result_student = $conn->query($sql_student);

        if ($result_student->num_rows > 0){
            $student = $result_student->fetch_assoc();
            
             echo "<div class=\"content\" style=\"width:100%\">";
            // echo "<label><p>".$student["student_first_name"]." ".$student["student_last_name"]."</p></label>";    
            // echo "<label><p>".$appl["student_email"]."</p></label>"; 
            // echo "<label><p>".$appl["name"]."</p></label>"; 
            // echo "<label><p>".$appl["semester"]."</p></label>"; 
            // echo "<label><p>".$appl["dept_code"]."</p></label>"; 
            // echo "<label><p>".$appl["assigned_to"]."</p></label>"; 
            echo "<table class=\"table list-table\">";
            echo "<h2 class=\"table-header\">Application Information</h2>";
            echo "<tr>";
            echo "<th > Student Name </td>";
            echo "<td>".$student["student_first_name"]." ".$student["student_last_name"]."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th > Student Email </td>";
            echo "<td>".$appl["student_email"]."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th > Course Number </td>";
            echo "<td>".$appl["dept_code"]." ".$appl["class_number"]."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th > Semester </td>";
            echo "<td>".$appl["semester"]." ".$appl["year"]."</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<th > Department Code </td>";
            echo "<td>".$appl["dept_code"]."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th > Faculty Advisor Email </td>";
            echo "<td>".$appl["instructor_email"]."</td>";
            echo "</tr>";

            echo "<tr style=\"border-bottom:1px solid #ddd\">";
            echo "<th > Assigned to </td>";
            echo "<td>".$appl["assigned_to"]."</td>";
            echo "</tr>";

            echo "</table>";
            echo "</div>";
            
        }
    }
}
else {
    echo "no results";
}

mysqli_close($conn);
?>


        <!-- </tbody>
        
    </table> -->

</div>

<?php
include('component_template.foot.php');

?>