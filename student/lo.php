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



if (isset($_GET['fwid'])) {  //check for exising fwid
    $sql = "SELECT * FROM s20_application_util WHERE fw_id = " . $_GET['fwid']; //checks if its a reject
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    $fwid = $_GET['fwid'];
    if ($r == 1) { //if application is found
        if (isset($_GET['exist']) and $_GET['exist'] == 1) { //if special param is set. Populate vcariable to set on page
            $sql = "SELECT * FROM s20_company_info WHERE fw_id = " . $_GET['fwid'];
            $qsql  = mysqli_query($db_conn, $sql);
            $r = mysqli_num_rows($qsql);
            $result = mysqli_fetch_assoc($qsql);
            $project_info = $result['project_info'];
            $project_info = unserialize($project_info);
        }
    } else if (!isset($_GET['exist'])) { //else 
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
                        <textarea id="textarea" name="textarea" value="<?php showifnotnull($firstname); ?>" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea1">How is the proposal related to your major areas of interest? Describe the course work you have completed which
                            provides appropriate background to the project.</label>
                        <textarea id="textarea1" name="textarea1" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea2">What is the proposed method of study? Where appropriate, cite readings and practical experience.</label>
                        <textarea id="textarea2" name="textarea2" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>

                    <div class="form-group mt-5">
                        <?php if (isset($_GET['exist']) and $_GET['exist'] == 1) { ?>
                            <button name="save" type="submit" class="btn btn-primary float-right">Save</button>
                        <?php } else { ?>
                            <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>
                        <?php } ?>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>






<?php

include_once('components/footer.php');
//semester form to input into database
?>