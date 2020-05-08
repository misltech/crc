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
if (isset($_GET['course']) and isset($_GET['department'])) {
    $dept = mysqli_real_escape_string($db_conn, $_GET['department']);
    $course = mysqli_real_escape_string($db_conn, $_GET['course']);
    $sql  = "SELECT * FROM s20_course_numbers WHERE dept_code = '$dept' AND course_number= '$course'";
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    if ($r == 1) {   //if department exist
        $course_result = mysqli_fetch_assoc($qsql);
        $dept = $course_result['dept_code'];
        $course = $course_result['course_number'];
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
        <p class="font-weight-bold">Course: <?php echo $_GET['department'] . " " .  $_GET['course']; ?></p>
        <hr class="my-4">

        <div class="row assigned_fac_head">
            <h6 class="lead m-3">Assigned Faculty</h6>
            <div class="m-4">
                <div class="row">
                    <?php
                    $findfacultysql  = "SELECT * FROM s20_faculty_info WHERE s20_faculty_info.classes IN (SELECT id FROM s20_course_numbers WHERE dept_code='$dept' AND course_number = '$course')";
                    $findfacultyquery  = mysqli_query($db_conn, $findfacultysql);
                    if (mysqli_errno($db_conn) == 0) {
                        while ($r = mysqli_fetch_assoc($findfacultyquery)) {

                            $fn = $r['faculty_first_name'];
                            $ln = $r['faculty_last_name'];
                            $mi = $r['faculty_middle_initial'];
                            $pn = $r['faculty_phone_number'];
                            $oh = $r['office_hours'];
                    ?>
                            <div class="card bg-light col-4 m-2" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Faculty</h5>
                                    <p class="card-title"><?php echo $fn . " " . $ln . " " . $mi; ?></p>
                                    <p class="card-title"><?php echo $pn; ?></p>
                                    <p class="card-title"><?php echo $oh; ?></p>
                                </div>
                            </div>



                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <div class="container ">

            <h6 class="lead m-3 ">Assign a Faculty(Drag and Drop)</h6>

            <div class="row m-4">

                <div id="sortableleft" class="list-group col partipants_drag_drop">
                    <h6>Available faculty thats in the system</h6>
                    <div class="list-group-item">Professor Liu</div>
                    <div class="list-group-item">Professor King</div>
                </div>
                <div id="sortableright" class="list-group col partipants_drag_drop">
                    <h6>Assigned to this class currently</h6>
                    <div class="list-group-item">Professor Blah</div>
                </div>

                <div class="col-12">
                    <div class="offset-4 col-8">
                        <button id="submit-assign" class="btn btn-secondary m-3 float-right">Save Assign</button>
                    </div>
                </div>
            </div>




        </div>
        <hr class="my-4">
        <h6 class="lead m-3">Edit Course Attributes</h6>
        <div class="row assigned_fac_head">
            <form class="mx-auto" method="POST">
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
        <hr class="my-4">
        <div class="row assigned_fac_head">


            <form method="POST" class="mx-auto">
                <div class="col-12 mx-auto">
                    <h6 class="lead m-3 d-inline">Delete Course</h6>
                    <button name="submit" type="submit" class="btn btn-xs btn-danger d-inline">Delete</button>
                </div>
            </form>
        </div>
    </div>


</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js"></script>
<script src="../js/admin.js"></script>
<script>
    new Sortable(sortableleft, {
        group: 'shared', // set both lists to same group
        animation: 150
    });

    new Sortable(sortableright, {
        group: 'shared',
        animation: 150
    });
</script>

<?php
include_once('components/footer.php');
?>