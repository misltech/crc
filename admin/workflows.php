<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<!-- 
SELECT concat(student_first_name, ' ' , student_last_name) as Name, s20_application_info.student_email, semester, concat(s20_application_info.dept_code, ' ', class_number) as Course, s20_application_info.instructor_email,  assigned_to, s20_application_info.fw_id
            FROM s20_application_info 
            LEFT JOIN s20_student_info ON s20_application_info.banner_id = s20_student_info.banner_id 
             -->

<!--Table-->
<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">View Workflows</h1>
        <p class="lead">You can view and modify current workflows here.</p>
        <p class="lead danger">No data is found if table is empty!</p>
        <hr class="my-4">
        <table id="example" class="table table-responsive table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Course #</th>
                    <th>Semester</th>
                    <th>Faculty Email</th>
                    <th>Assigned to: </th>
                    <th>Modify </th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once('../newback/db_con3.php');

                $sql = "SELECT concat(student_first_name, ' ' , student_last_name) as Name, s20_application_info.student_email, semester, concat(s20_application_info.dept_code, ' ', class_number) as Course, s20_application_info.instructor_email, assigned_to, s20_application_info.fw_id FROM s20_application_info LEFT JOIN s20_student_info ON s20_application_info.banner_id = s20_student_info.banner_id";
                $run = mysqli_query($db_conn, $sql);
                //alert($run);
                if (!$run) { //if failed to reach database
                    //errorlog this
                    exit();
                }

                while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {  //for each email
                    $name = $row['Name'];
                    $email = $row["student_email"];
                    $course = $row['Course'];
                    $semester = $row['semester'];
                    $facultyemail = $row['instructor_email'];
                    $assigned = $row['assigned_to'];
                    $fwid = $row['fw_id'];
                    $modify = null;
                 
                ?>

                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $course; ?></td>
                        <td><?php echo $semester; ?></td>
                        <td><?php echo $facultyemail; ?></td>
                        <td><?php echo $assigned; ?></td>
                        <td><a class="btn btn-primary btn-block" href="#">Modify</a></button></td>
                    </tr>


                <?php  } ?>
                </tfoot>
        </table>
    </div>
</div>

<?php
include_once('components/footer.php');
?>