<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
include_once '../backend/db_con3.php';

?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Modify Department</h1>
        <p class="lead">Change workflow and other stuff here</p>
        <hr class="my-4">
        <?php if (isset($_GET['success']) and $_GET['success'] == 'true' and isset($_GET['workflow']) and $_GET['workflow'] == 'true') { ?>
            <div class="col-6 mx-auto alert alert-success fade show">
                Workflow updated!
            </div>
        <?php } else if (isset($_GET['success']) and $_GET['success'] == 'true' and isset($_GET['emails']) and $_GET['emails'] == 'true') { ?>
            <div class="col-6 mx-auto alert alert-success fade show">
               Emails updated!
            </div>
        <?php } else if (isset($_GET['error'])) { ?>
            <div class="col-6 mx-auto alert alert-info fade show">
                <?php echo $_GET['error']; ?>
            </div>

        <?php } ?>

        <div class="container">
            <!--This will keep the order list --->
            <h6 class="lead text-center m-3">Edit Workflow (Drag and drop particpants)</h6>
            <?php

            if (isset($_GET['department']) and $_SESSION['user_type'] == "admin") {
                $dept = $_GET['department'];
                $sql  = "SELECT * FROM s20_academic_dept_info WHERE dept_code = '$dept'";
                $deptinfoQuery  = mysqli_query($db_conn, $sql);
                $deptinforesult = mysqli_fetch_assoc($deptinfoQuery);
                $r = mysqli_num_rows($deptinfoQuery);
                if ($r == 1) {   //if department is found
                    $sql  = "SELECT * FROM s20_workflow_order WHERE dept_code = '$dept'";
                    $workflowquery  = mysqli_query($db_conn, $sql);
                    $r2 = mysqli_num_rows($workflowquery);
                    $result = mysqli_fetch_assoc($workflowquery);
                    if ($r2 == 1) {
                        $order = $result['workflow'];
                        $order = unserialize($order);
                        showExisting($order);
                    }
                } else {
                    header('Location: ./viewdepartment.php');
                }
            } else {
                header('Location: ./viewdepartment.php');
            }

            ?>

            <?php function showExisting($order)
            {  ?>
                <div class="row">

                    <div id="sortableleft" class="list-group col partipants_drag_drop">
                        <h6> Available Participants</h6>

                        <?php
                        $defaultorder = array('Student', 'Instructor', 'Employer', 'Chair', 'Dean', 'Records&Registration');
                        $array_difference = array_values(array_diff($defaultorder, $order));
                        for ($k = 0; $k < count($array_difference); $k++) {
                            $differenceval = $array_difference[$k];

                        ?>
                            <div class="list-group-item"><?php echo $differenceval ?></div>

                        <?php } ?>
                        </ul>
                    </div>
                    <div id="sortableright" class="list-group col partipants_drag_drop">
                        <h6> Current Participants</h6>
                        <!-- <ul class="list-group"> -->
                        <?php
                        for ($i = 0; $i < count($order); $i++) {
                            $temporder = $order[$i];
                        ?>
                            <div class="list-group-item"><?php echo $temporder ?></div>
                    <?php   }
                    } ?>

                    <!-- </ul> -->
                    </div>
                    <div class="col-12">
                        <div class="offset-4 col-8">
                            <button id="submit-workflow" class="btn btn-secondary m-3 float-right">Save Workflow</button>
                        </div>
                    </div>
                </div>
        </div>

        <hr class="my-4">
        <h6 class="lead text-center m-3">Edit Assigned Emails</h6>
        <div class="container">
            <form class="col-md-8 mx-auto" method="POST">
                <div class="form-group row">
                    <label for="ce" class="col-4 col-form-label">Chair email</label>
                    <div class="col-8">
                        <input id="ce" name="ce" value="<?php echo $deptinforesult['chair_email']; ?>" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="de" class="col-4 col-form-label">Department email</label>
                    <div class="col-8">
                        <input id="de" name="de" value="<?php echo $deptinforesult['dean_email']; ?>" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="se" class="col-4 col-form-label">Secretary email</label>
                    <div class="col-8">
                        <input id="se" name="se" value="<?php echo $deptinforesult['secretary_email']; ?>" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="modifyemails" type="submit" class="btn btn-secondary float-right">Save Emails</button>
                    </div>
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

<script src="../js/sequence.js"></script>
<?php

if (isset($_POST['modifyemails'])) {

    $deptemail = mysqli_real_escape_string($db_conn, $_POST['de']);
    $chairemail = mysqli_real_escape_string($db_conn, $_POST['ce']);
    $deptsecemail = mysqli_real_escape_string($db_conn, $_POST['se']);
    
    $updateemailSQL = "UPDATE s20_academic_dept_info (chair_email, dean_email, secretary_email) VALUES ('$deptemail','$chairemail','$deptsecemail')";
    $updateemailQuery = mysqli_query($db_conn, $updateemailSQL);

    if (mysqli_errno($db_conn) == 0) { 
            header('Location: ./editdepartment.php?success=true&emails=true');
    }
    else{
        header('Location: ./editdepartment.php?error='.mysqli_errno($db_conn));
    }

}
include_once('components/footer.php');
?>