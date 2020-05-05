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
            <div class="row m-4">
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
                <h6><?php echo $fn; ?></h6>
                <h6><?php echo $ln; ?></h6>
                <h6><?php echo $mi; ?></h6>
                <h6><?php echo $pn; ?></h6>
                <h6><?php echo $oh; ?></h6>
            </div>
        </div>


        <div class="container">
            <hr class="my-4">
            <h6 class="lead text-center m-3">Edit Assigned Faculty</h6>
            <div class="row m-4">
                <form class="col-md-10" method="POST">
                    <div class="form-group row">
                        <label for="text" class="col-4 col-form-label">Enter new faculty email</label>
                        <div class="col-8">
                            <input id="newfac" name="newfac" type="email" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-secondary float-right">Assign</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <hr class="my-4">
            <h6 class="lead text-center m-3">Edit Course Number</h6>
            <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="dpp">Department</label>
                    <input id="dpp" name="dpp" type="text" class="form-control" required="required">
                </div>
                <div class="form-group col-md-2">
                    <label for="cnn">Course Number</label>
                    <input id="cnn" name="cnn" type="text" class="form-control" required="required">
                </div>
                <div class="form-group col-md-2 align-bottom">
                    <button name="submit" type="submit" style="margin-top: 33px;" class="btn btn-secondary">Save</button>
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