<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">View Workflows <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <button class="btn btn-secondary dropdown-toggle ml-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Workflow Settings
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./createdepartment.php">Add a New Application</a>
                     
                    </div>
                </div>
            </span></h1>
        <p class="lead">You can view and modify current workflows here.</p>
        <hr class="my-4">
        <table id="worktbl" class="table table-responsive table-striped table-bordered" style="width:100%">
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

                while ($row = mysqli_fetch_assoc($run)) {  //for each email
                    $name = $row['Name'];
                    $email = $row["student_email"];
                    $course = $row['Course'];
                    $semester = $row['semester'];
                    $facultyemail = $row['instructor_email'];
                    $assigned = $row['assigned_to'];
                    $fwid = $row['fw_id'];
                    $modify = null;
                    console_log($row);
                ?>

                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $course; ?></td>
                        <td><?php echo $semester; ?></td>
                        <td><?php echo $facultyemail; ?></td>
                        <td><?php echo $assigned; ?></td>
                        <td><a class="btn btn-primary btn-block" href="#">View</a></button></td>
                    </tr>


                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>




<?php
include_once('components/footer.php');

?>