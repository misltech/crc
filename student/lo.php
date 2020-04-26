<?php

//Learning objective questions. 
//objectives are determined by data from the database.
//Save their responses in database and move to next.
//This should also check if they have a data already and fill data.

if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');


if (isset($_GET['fwid'])) {  //check for exising fwid
    $fwid = $_GET['fwid'];
    $sql = "SELECT * FROM s20_application_util WHERE fw_id = '$fwid'"; //checks if its a reject
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);

    if ($r == 1) { //if application is found
        if (isset($_GET['new']) and $_GET['new'] == false) { //if special param is set. Populate vcariable to set on page
            $sql = "SELECT * FROM s20_company_info WHERE fw_id = " . $_GET['fwid'];
            $qsql  = mysqli_query($db_conn, $sql);
            $r = mysqli_num_rows($qsql);
            $result = mysqli_fetch_assoc($qsql);
            $project_info = $result['project_info'];
            $project_info = unserialize($project_info);
        }
    } else if (isset($_GET['new']) and $_GET['new'] = true) {
        //assume a new application. Dont populate
    }
} else {
    //header('Location: ./application.php'); //redirect if no fwid is in url
}


?>


<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Project Information</h1>
        <p class="lead">Describe your proposed fieldwork project.</p>
        <hr class="my-4">

        <div class="row">
            <div class="col-md-8 order-md-1 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="textarea">What are your responsibilities on the site? What special project will you be working on? What do you expect to learn?</label>
                        <textarea id="textarea" name="lo1" value="<?php showifnotnull($firstname); ?>" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea1">How is the proposal related to your major areas of interest? Describe the course work you have completed which
                            provides appropriate background to the project.</label>
                        <textarea id="textarea1" name="lo2" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea2">What is the proposed method of study? Where appropriate, cite readings and practical experience.</label>
                        <textarea id="textarea2" name="lo3" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>

                    <div class="form-group mt-5">
                        <?php if (isset($_GET['new']) and $_GET['new'] == true) { ?>
                            <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>

                        <?php } else { ?>
                            <button name="save" type="submit" class="btn btn-primary float-right">Save</button>
                        <?php } ?>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>


<?php
if (isset($_POST['proceed'])) {
    $firstprompt = mysqli_real_escape_string($db_conn, $_POST['lo1']);
    $secondprompt = mysqli_real_escape_string($db_conn, $_POST['lo2']);
    $thirdprompt = mysqli_real_escape_string($db_conn, $_POST['lo3']);

    $insert = "INSERT INTO s20_project_info(fw_id, project_response1, project_response2, project_response3) VALUES('$fwid','$firstprompt', '$secondprompt', '$thirdprompt')";
    $insertsql = mysqli_query($db_conn, $insert);

    if ($insertsql) {
        exit(header('Location: ./lo.php?fwid=' . $fwid . "&new=true"));
    } else  if (mysqli_errno($db_conn) == 1062) {
        exit(header('Location: ./lo.php?fwid=' . $fwid . "&new=false"));
    }
} else if (isset($_POST['save'])) {
    $firstprompt = mysqli_real_escape_string($db_conn, $_POST['lo1']);
    $secondprompt = mysqli_real_escape_string($db_conn, $_POST['lo2']);
    $thirdprompt = mysqli_real_escape_string($db_conn, $_POST['lo3']);

    $update    = "UPDATE s20_project_info SET project_response1 = '$firstprompt', project_response2 = '$secondprompt', project_response3 = '$thirdprompt'";
    $updatesql = mysqli_query($db_conn, $update);

    if ($updatesql) {
        exit(header('Location: ./review.php?fwid=' . $fwid . "&rej=1"));
    } else {
        alert("Something went very wrong");
    }
}

include_once('components/footer.php');
//semester form to input into database
?>