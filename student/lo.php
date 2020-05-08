<?php
ob_start();
//Learning objective questions. 
//objectives are determined by data from the database.
//Save their responses in database and move to next.
//This should also check if they have a data already and fill data.


    session_start();


include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');

global $firstresponse;
global $secondresponse;
global $thirdresponse;
global $existing_app;
if (isset($_GET['fwid'])) {  //check for exising fwid
    $fwid = $_GET['fwid'];
    $stuemail = $_SESSION['user_email'];
    $sql  = "SELECT * FROM s20_application_info WHERE fw_id = '$fwid' AND student_email = '$stuemail'"; //checks if they are allowed to view page
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    if ($r == 1) { //if application is found
        $projsql = "SELECT * FROM s20_project_info WHERE fw_id = '$fwid'";
        $projquery  = mysqli_query($db_conn, $projsql);
        $r = mysqli_num_rows($projquery);
        if ($r == 1) {
            $result = mysqli_fetch_assoc($projquery);
            $firstresponse = $result['project_response1'];
            $secondresponse = $result['project_response2'];
            $thirdresponse = $result['project_response3'];
            $existing_app = true;
        } else {
            $existing_app = false;
        }
    } else {
        header('Location: ./application.php'); //redirect if no application found.
    }
} else {
    header('Location: ./application.php'); //redirect if no fwid is in url
}


?>


<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Project Information</h1>
        <p class="lead">Describe your proposed fieldwork project.</p>
        <hr class="my-4">

        <div class="row">
            <div class="col-md-8 order-md-1 mx-auto">
                <form method="post">
                    <div class="form-group">
                        <label for="textarea">What are your responsibilities on the site? What special project will you be working on? What do you expect to learn?</label>
                        <textarea id="textarea" name="lo1" value="" cols="40" rows="5" class="form-control" required="required"><?php echo $firstresponse; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea1">How is the proposal related to your major areas of interest? Describe the course work you have completed which
                            provides appropriate background to the project.</label>
                        <textarea id="textarea1" name="lo2" value="" cols="40" rows="5" class="form-control" required="required"><?php echo $secondresponse; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea2">What is the proposed method of study? Where appropriate, cite readings and practical experience.</label>
                        <textarea id="textarea2" name="lo3" value="" cols="40" rows="5" class="form-control" required="required"><?php echo $thirdresponse; ?></textarea>
                    </div>

                    <div class="form-group mt-5">
                        <?php if ($isset($_GET['edit']) and $_GET['edit'] == 'true') { ?>
                            <button name="save" type="submit" class="btn btn-primary float-right">Save</button>

                        <?php } else if(!$existing_app){ ?>
                            <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>
                        <?php } ?>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>


<?php
if (isset($_POST['proceed']) or isset($_POST['save'])) {
    $firstprompt = mysqli_real_escape_string($db_conn, $_POST['lo1']);
    $secondprompt = mysqli_real_escape_string($db_conn, $_POST['lo2']);
    $thirdprompt = mysqli_real_escape_string($db_conn, $_POST['lo3']);

    if ($existing_app) {
        $update    = "UPDATE s20_project_info SET project_response1 = '$firstprompt', project_response2 = '$secondprompt', project_response3 = '$thirdprompt';";
        $updatesql = mysqli_query($db_conn, $update);

        if (mysqli_errno($db_conn) == 0) {   //redirect based on edit flagged from student review.
            if(isset($_GET['edit']) and $_GET['edit'] == 'true'){
                exit(header('Location: ./review.php?fwid=' . $fwid));
              }
            exit(header('Location: ./review.php?fwid=' . $fwid));
        } else {
            alert("Update failed: " . mysqli_errno($db_conn));
        }
    } else {
        $insertsql = "INSERT INTO s20_project_info(fw_id, project_response1, project_response2, project_response3) VALUES('$fwid','$firstprompt', '$secondprompt', '$thirdprompt')";
        $updateUtilsql = "UPDATE s20_application_util SET progress='0' WHERE fw_id ='$fwid'";
        $insertquery = mysqli_query($db_conn, $insertsql);
        if (mysqli_errno($db_conn) == 0) {
            $updateUtilquery = mysqli_query($db_conn, $updateUtilsql);
            if(mysqli_errno($db_conn) == 0){
                exit(header('Location: ./review.php?fwid=' . $fwid));
            }
        } else {
            alert("Insert failed " . mysqli_errno($db_conn));
        }
    }
}



include_once('components/footer.php');
//semester form to input into database
?>