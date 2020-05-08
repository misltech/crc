<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">View Applications <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <div class="d-inline float-right dropdown">
                        <button class="btn btn-secondary  ml-auto" type="button" onclick="window.location.href='#'">Add Application</button>
                    </div>
                </div>
            </span></h1>
        <p class="lead">You can view and modify current workflows here.</p>
        <hr class="my-4">
        <table id="worktbl" class="table table-responsive table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Student Email</th>
                    <th>Course #</th>
                    <th>Semester</th>
                    <th>Assigned to: </th>
                    <th>Modify </th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once('../backend/db_con3.php');

                $sql = "SELECT s20_application_info.student_email, concat(s20_application_info.semester, ' ', s20_application_info.year) 
                        AS semyear, concat(s20_application_info.dept_code, ' ', course_number) 
                        AS Course, s20_application_info.instructor_email, assigned_to, s20_application_info.fw_id 
                        FROM s20_application_info INNER JOIN s20_application_util ON s20_application_info.fw_id = s20_application_util.fw_id";
                $run = mysqli_query($db_conn, $sql);
                //alert($run);
                if (!$run) { //if failed to reach database
                    //errorlog this
                    exit();
                }

                while ($row = mysqli_fetch_assoc($run)) {  //for each email
                    $email = $row["student_email"];
                    $course = $row['Course'];
                    $semester = $row['semyear'];
                    $assigned = $row['assigned_to'];
                    $fwid = $row['fw_id'];
                    console_log($row);
                ?>

                    <tr>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $course; ?></td>
                        <td><?php echo $semester; ?></td>
                        <td><?php echo $assigned; ?></td>
                        <td><a class="btn btn-primary btn-block" href="./viewapplicationdetail.php?fwid=<?php echo $fwid; ?>">View</a></button></td>
                    </tr>


                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>




<?php
include_once('components/footer.php');

?>