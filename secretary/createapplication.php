<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once '../backend/db_con3.php';


global $showappcreation;
global $appemail;

if (isset($_GET['found']) and $_GET['found'] == 'true' and isset($_GET['uniquesearch'])) {
    $e = $_GET['uniquesearch'];
    $ch = "SELECT * FROM s20_UserPass WHERE email = '$e'";
    $q = mysqli_query($db_conn, $ch);
    if (mysqli_num_rows($q) == 1) {
        $appemail = $e;
        $showappcreation = true;
    } else {
        header('Locaton: ./createapplication.php');
    }
} else {
    $showappcreation = false;
}


?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">New Application</h1>
        <p class="lead">Select the required information, then hit Submit Application. You can only search for a student here.</p>
        <hr class="my-4">
        <?php if (isset($_GET['success']) and $_GET['success'] == 'false') { ?>
            <div class="col-6 mx-auto alert alert-warning fade show">
                User not found!
            </div>
        <?php } ?>
        <?php if (isset($_GET['applicationsuccess']) and $_GET['applicationsuccess'] == 'true') { ?>
            <div class="col-6 mx-auto alert alert-success fade show">
                Application created!
            </div>
        <?php } ?>
        <div class="d-flex justify-content-center mt-5">
            <?php if ($showappcreation) { ?>
                <form method="POST">
                    <div class="form-group row">
                        <label for="type"> Creating application for: <b><?php echo $_GET['uniquesearch']; ?></b> </label>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-4 col-form-label">Course</label>
                        <div class="col-8">
                            <select id="type" name="utype" class="custom-select" size="1" value="" required="required">
                                <?php
                                $sql = "SELECT * FROM s20_course_numbers ORDER BY dept_code ASC"; //table of courses
                                $qsql  = mysqli_query($db_conn, $sql);
                                $r = mysqli_num_rows($qsql);

                                if ($r > 0) { //if there are courses in the table
                                    while ($result = mysqli_fetch_assoc($qsql)) { //itterate through each row  
                                        $id = $result['id']; //returns ID of course
                                        $deptcode = $result['dept_code']; //gets dept code: CPS
                                        $coursenum = $result['course_number']; //gets course number: 100
                                        $course = $deptcode . " " . $coursenum; //concat: CPS 100

                                ?>
                                        <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-4 col-form-label">Semester</label>
                        <div class="col-8">
                            <select id="type" name="sem" class="custom-select" required="required">
                                <option value="Spring <?php echo date('Y'); ?>">Spring <?php echo date('Y'); ?></option>
                                <option value="Spring <?php echo date('Y'); ?>">Summer <?php echo date('Y'); ?></option>
                                <option value="Spring <?php echo date('Y'); ?>">Fall <?php echo date('Y'); ?></option>
                                <option value="Spring <?php echo date('Y'); ?>">Winter <?php echo date('Y'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gm" class="col-4 col-form-label">Grade Type</label>
                        <div class="col-8">
                            <select id="gm" value="<?php echo $grademode; ?>" name="gm" required="required" class="custom-select">
                                <option value="Letter Grades">Letter Grades</option>
                                <option value="Pass/Fail">Pass/Fail</option>
                            </select>
                        </div>
                    </div>


                    <button name="submitApp" type="submit" class="btn btn-primary float-right">Create Application</button>
                </form>
        </div>
    </div>
</div>
</span></h1>


<?php } else { ?>
    <form method="POST">
        <div class="form-group">
            <label for="email-search">Enter a students hawkmail </label>
            <input id="email-search" name="email-search" type="email" class="form-control" aria-describedby="uniquesearchHelpBlock" required="required">
            <span id="uniquesearchHelpBlock" class="form-text text-muted">email@hawkmail.newpaltz.edu</span>
            <!--If invalid email must return error-->
        </div>

        <div class="form-group">
            <button name="uniquesearch" type="submit" class="btn btn-primary float-right">Search</button>
        </div>
    </form>
    </div>
    </div>
    </div>

<?php } ?>
<?php

if (isset($_POST['uniquesearch'])) { //handles student search button
    $email = mysqli_real_escape_string($db_conn, $_POST['email-search']);

    $sql = "SELECT * FROM s20_UserPass WHERE email = '$email' AND profile_type = 'student'";
    $query = mysqli_query($db_conn, $sql);
    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            header('Location: ./createapplication.php?found=true&uniquesearch=' . $email); //if true then redirect to application form with value of email 
        } else {
            //return error if not a valid email
            header('Location: ./createapplication.php?success=false');
        }
    }
}
if (isset($_POST['submitApp'])) { //handles Application submit button
    $type = mysqli_real_escape_string($db_conn, $_POST['utype']);
    $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
    $grademode = mysqli_real_escape_string($db_conn, $_POST['gm']);
    $sem = explode(" ", $sem);
    $type = explode(" ", $type);
    $semester = $sem[0];
    $year = $sem[1];
    $dept = $type[0];
    $course = $type[1];

    $fwid = bin2hex(random_bytes(32));  //duplication is unlikely with this one. 1 in 20billion apparently
    $newappsql = "INSERT INTO s20_application_info(fw_id, dept_code, course_number, student_email, semester, year,grade_mode) VALUES ('$fwid','$dept', '$course','$appemail', '$semester', '$year', '$grademode');"; ///get department code
    $newutilsql = "INSERT INTO s20_application_util(fw_id, progress, rejected, assigned_to, assigned_when) VALUES ('$fwid', '-1', '0', 'student', 'CURRENT_TIMESTAMP');";
    $insql = mysqli_query($db_conn, $newappsql);
    if (mysqli_errno($db_conn) == 0) {
        $insql = mysqli_query($db_conn, $newutilsql);
        if (mysqli_errno($db_conn) == 0) {
            header('Location: ./createapplication.php?applicationsuccess=true');
        }
    }
}

include_once('components/footer.php');
?>