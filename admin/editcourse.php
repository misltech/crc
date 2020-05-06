<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
include_once '../backend/db_con3.php';

global $course_result;
if (isset($_GET['course']) and isset($_GET['department']) and $_SESSION['user_type'] == "admin") {
    $dept = mysqli_real_escape_string($db_conn, $_GET['department']);
    $course = mysqli_real_escape_string($db_conn, $_GET['course']);

    $sql  = "SELECT * FROM s20_course_numbers WHERE dept_code = '$dept' AND course_number= '$course'";
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    if ($r == 1) {   //if department is found
        $course_result = mysqli_fetch_assoc($qsql);
    } else {
        header('Location: ./addcourse.php');
    }
} else {
    header('Location: ./viewcourse.php');
}
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Edit Courses</h1>
        <p class="lead">Various course modifications can be done here</p>
        <p class="bold">Course: <?php echo $_GET['department'] . " " .  $_GET['course']; ?></p>
        <hr class="my-4">

        <div class="container">
            <h6 class="lead m-3">Assigned Faculty</h6>
            <div class="m-4">
                <?php
                $fac_email = $course_result['faculty_email'];
                $sql  = "SELECT * FROM s20_faculty_info WHERE faculty_email = '$fac_email'";
                $qsql  = mysqli_query($db_conn, $sql);
                if (mysqli_errno($db_conn) == 0) {
                    $faculty_result = mysqli_fetch_assoc($qsql);
                    $fn = $faculty_result['faculty_first_name'];
                    $ln = $faculty_result['faculty_last_name'];
                    $mi = $faculty_result['faculty_middle_initial'];
                    $pn = $faculty_result['faculty_phone_number'];
                    $oh = $faculty_result['office_hours'];
                } else {
                    alert("Failed to get course info");
                }
                ?>
                <p><?php echo $fn . " " . $ln. " " . $mi; ?></p>
                <p><?php echo $pn; ?></p>
                <p><?php echo $oh; ?></p>
            </div>
        </div>


        <div class="container">
            <hr class="my-4">
            <h6 class="lead text-center m-3">Edit Assigned Faculty</h6>
            
            <div class="row m-4">
                <form class="col-md-10" method="POST">
                    <div class="form-group row">
                        <label for="text" class="col-4 col-form-label">Enter new faculty email</label>
                        <div class="col-6">
                            <input id="newfac" name="newfac" type="email" class="form-control" required="required">
                        </div>
                        <div>
                            <button name="assign-new" type="submit" class="btn btn-secondary float-right">Assign</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="container">
            <hr class="my-4">
            <h6 class="lead text-center m-3">Edit Course Attributes</h6>
            <form class="col-md-12" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <label for="dpp">Department</label>
                    <input id="dpp" name="dpp" type="text" class="form-control" required="required">
                </div>
                <div class="col-md-4">
                    <label for="cnn">Course Number</label>
                    <input id="cnn" name="cnn" type="text" class="form-control" required="required">
                </div>
                <div class="col-md-4">
                    <button name="update-course" type="submit" style="margin-top: 33px;" class="btn btn-secondary">Save</button>
                </div>
            </div>
                
            </form>
        </div>



        <div class="container">
            <hr class="my-4">
            <h6 class="lead text-center m-3">Delete Course</h6>
            <form method="POST">
                <div class="form-group row">
                    <div class="col-2 mx-auto">
                        <button name="submit" type="submit" class="btn btn-block btn-danger ">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
</div>

<script src="../js/sequence.js"></script>
<?php
include_once('components/footer.php');
?>