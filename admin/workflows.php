<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="m-3">
    <legend>View Workflows</legend>
</div>


<!--Table-->
<div class="container " style="overflow: auto;">
    <table id="example" class="table table-responsive table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Course #</th>
                <th>Semester</th>
                <th>Department Code</th>
                <th>Faculty Email</th>
                <th>Assigned to: </th>
                <th>Modify </th>
            </tr>
        </thead>
        <tbody>

            <?php
            include_once('../newback/db_con3.php');

            $query = 'SELECT * FROM s20_application_info';
            $run = mysqli_query($db_conn, $query);

            if (!$run) { //if failed to reach database
                //errorlog this
                exit();
            } else if (mysqli_num_rows($run) == 0) {
                //no workflows available

            
            ?>
            <!-- no workflow html stuff ehre -->
            
            <?php  
     
        }else if (mysqli_num_rows($run) > 0) { //workflows found
                
                while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {  //for each email
                    $studentemail = $row['student_email']; //get email associated with workflow?
                    $individualstudentquery = "SELECT * FROM s20_student_info WHERE student_email='$studentemail'";
                    $runstudent = mysqli_query($db_conn, $individualstudentquery);

                    if (!$runstudent) { //if failed to reach database
                        //errorlog this
                        exit();
                    } else if (mysqli_num_rows($runstudent) > 0 and $studentrow = mysqli_fetch_array($runstudent, MYSQLI_ASSOC)) {
                        
                        
                        $name = $studentrow['student_first_name'] . " " . $studentrow['student_last_name'];
                        $email = $studentrow["student_email"];
                        $course = $row['dept_code'] . " " . $row['class_number'];
                        $semester = $row['semester'] . " " . $row['year'];
                        $department = $row['dept_code'];
                        $facultyemail = $row['instructor_email'];
                        $assigned = $row['assigned_to'];
                        $modify = null;
                ?>

                                <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $course; ?></td>
                            <td><?php echo $semester; ?></td>
                            <td><?php echo $department; ?></td>
                            <td><?php echo $facultyemail; ?></td>
                            <td><?php echo $assigned; ?></td>
                            <td><button><a href="#">Modify</a></button></td>
                        </tr>
       
            <?php  }
                }
            } 
            else {
                //no idea log this.
            }

            ?>
            </tfoot>
    </table>
</div>


<?php
include_once('components/footer.php');
?>