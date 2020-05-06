<?php
error_reporting(E_ERROR | E_PARSE);
if (!isset($_SESSION)) {
    session_start();
}

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
include_once '../backend/db_con3.php';

global $appinfo;
global $fwid;
if (isset($_GET['fwid'])) {
    $fwid = mysqli_escape_string($db_conn, $_GET['fwid']);
    $appinfosql = "SELECT * FROM s20_application_info WHERE fw_id='$fwid'";
    $run = mysqli_query($db_conn, $appinfosql);
    if ($run and (mysqli_num_rows($run) == 1)) {
        $appinfo = mysqli_fetch_assoc($run);
    } else {
        header('Location: ./workflows.php');
    }
}

?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">View Application </h1>
        <p class="lead">You can view the deets of application here</p>
        <hr class="my-4">

        <div class="container">
            <table class="table review-sections table-hover">
                <thead>Application Deets</thead>
                <tbody>
                    <tr>
                        <td scope="row">Course</td>
                        <td><?php echo $appinfo['dept_code'] . " " . $appinfo['course_number'] ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Academic Semester</td>
                        <td><?php echo $appinfo['semester'] . " " . $appinfo['year'] ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Student Email</td>
                        <td><?php echo $appinfo['student_email'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Instructor Email</td>
                        <td><?php echo $appinfo['instructor_email'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Employer Email</td>
                        <td><?php echo $appinfo['employer_email'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Academic Credits</td>
                        <td><?php echo $appinfo['academic_credits'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Excess Credits</td>
                        <td><?php echo $appinfo['excess_credit'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Grade Mode</td>
                        <td><?php echo $appinfo['grade_mode'];?></td>
                    </tr>
                    <tr>
                        <td scope="row">Hours Weekly</td>
                        <td><?php echo $appinfo['hours_per_wk'];?></td>
                    </tr>

                </tbody>
            </table>


        </div>
        <div class="container">
            <?php

            global $cn;
            global $se;
            global $sp;
            global $sn;
            global $ca;

            $compsql = "SELECT * FROM s20_company_info WHERE fw_id='$fwid'";
            $rcompsql = mysqli_query($db_conn, $compsql);
            $rnumrow = mysqli_num_rows($rcompsql);
            if ($rnumrow == 1) {
                $rcompsqlresult = mysqli_fetch_assoc($rcompsql);
                $cn = $rcompsqlresult['company_name'];
                $se = $rcompsqlresult['supervisor_email'];
                $sp = $rcompsqlresult['supervisor_phone'];
                $sn = $rcompsqlresult['supervisor_first_name'] . " " . $rcompsqlresult['supervisor_last_name'];
                $ca = $rcompsqlresult['company_address'] . " " . $rcompsqlresult['company_address2'] . ", " . $rcompsqlresult['company_city'] . ", " . $cs = $rcompsqlresult['company_state'] . ", " . $rcompsqlresult['company_zip'];
            }

            ?>

            <table class="table review-sections table-hover">
                <thead>Employer Deets</thead>
                <tbody>
                    <tr>
                        <td scope="row">Workplace</td>
                        <td><?php echo $cn; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Supervisor email</td>
                        <td><?php echo $se; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Supervisor phone</td>
                        <td><?php echo $sp; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Supervisor name</td>
                        <td><?php echo $sn; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Worksite</td>
                        <td><?php echo $ca; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="container">

            <?php
            global $fr;
            global $sr;
            global $tr;

            $projsql = "SELECT * FROM s20_project_info WHERE fw_id='$fwid'";
            $projquery = mysqli_query($db_conn, $projsql);
            $projnumrow = mysqli_num_rows($rcompsql);
            if ($projnumrow == 1) {
                $projsqlresult = mysqli_fetch_assoc($projquery);
                $fr = $projsqlresult['project_response1'];
                $sr = $projsqlresult['project_response2'];
                $tr = $projsqlresult['project_response3'];
            }
            ?>

            <table class="table review-sections table-hover">
                <thead>Project deets</thead>
                <tbody>
                    <tr>
                        <td scope="row">Learning response1</td>
                        <td><?php echo $fr; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Learning response2</td>
                        <td><?php echo $sr; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Learning response3</td>
                        <td><?php echo $tr; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="container">

            <?php
            $d = $appinfo['dept_code'];
            $c = $appinfo['course_number'];

            global $fn;
            global $fp;
            global $foh;
            $getfacemail = "SELECT * FROM s20_course_numbers WHERE dept_code = '$d' AND course_number = '$c'";
            $getfacemailsql = mysqli_query($db_conn, $getfacemail);
            if ($getfacemailsql) {
                $getfacemail = mysqli_fetch_assoc($getfacemailsql);
                $getfacemailval = $getfacemail['faculty_email'];
                $facsql = "SELECT * FROM s20_faculty_info WHERE faculty_email = '$getfacemailval'";
                $facquery = mysqli_query($db_conn, $facsql);
                if ($facquery) {
                    $facresult = mysqli_fetch_assoc($facquery);
                    $fn = $facresult['faculty_first_name'] . " " . $facresult['faculty_last_name'];
                    $fp = $facresult['faculty_phone_number'];
                    $foh = $facresult['office_hours'];
                }
            }

            ?>

            <table class="table review-sections table-hover">
                <thead><tr>Assigned faculty</tr></thead>
                <tbody>
                    <tr>
                        <td scope="row">Instructor</td>
                        <td><?php echo $fn; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Phone</td>
                        <td><?php echo $fp; ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Office Hours</td>
                        <td><?php echo $foh;?> </td>
                    </tr>

                </tbody>
            </table>
        </div>
      </div>
</div>

<?php
include_once('components/footer.php');

?>