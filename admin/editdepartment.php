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

        <div class="container">
            <!--This will keep the order list --->
            <h6 class="lead text-center m-3">Edit Workflow</h6>

            <form class="row" method="POST">

                <?php

                if (isset($_GET['department']) and $_SESSION['user_type'] == "admin") {
                    $dept = $_GET['department'];
                    $sql  = "SELECT * FROM s20_academic_dept_info WHERE dept_code = '$dept'";
                    $qsql  = mysqli_query($db_conn, $sql);
                    $r = mysqli_num_rows($qsql);
                    if ($r == 1) {   //if department is found
                        $sql  = "SELECT * FROM s20_workflow_order WHERE dept_code = '$dept'";
                        $qsql  = mysqli_query($db_conn, $sql);
                        $r2 = mysqli_num_rows($qsql);
                        $result = mysqli_fetch_assoc($qsql);
                        if ($r2 == 1) {
                            $order = $result['workflow'];
                            $order = unserialize($order);
                            console_log($order);
                            showExisting($order);
                        } else if ($r2 == 0) {
                            //create a new workflow form
                            showNoneExisting();
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
                    <div class="col-6">
                        <h6> Available Workflows</h6>
                        <ul class="list-group sortable1 connected wflowstyle">
                            <?php
                            $defaultcode = array('Student', 'Instructor', 'Employer', 'Chair', 'Dean', 'Recreg');
                            $ad = array_values(array_diff($defaultcode, $order));
                            console_log($ad);
                            for ($k = 0; $k < count($ad); $k++) {
                                $adval = $ad[$k];

                            ?>
                                <li class="list-group-item"><input type="hidden" name="<?php echo $adval ?>"><?php echo $adval ?></input></li>

                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-6">
                        <h6> Current Workflow</h6>
                        <ul class="list-group sortable2 connected">
                            <?php
                            for ($i = 0; $i < count($order); $i++) {
                                $temporder = $order[$i];
                            ?>
                                <li class="list-group-item"><input type="hidden" name="<?php echo $temporder ?>"><?php echo $temporder ?></input></li>
                        <?php   }
                        } ?>


                        <?php function showNoneExisting()
                        {
                        }
                        ?>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="offset-4 col-8">
                            <button class="btn btn-secondary m-3 float-right" name="modify" type="submit">Save Workflow</button>
                        </div>
                    </div>
        </div>


        </form>

        <hr class="my-4">
        <h6 class="lead text-center m-3">Edit Assigned Emails</h6>
        <div class="container">
            <form class="col-md-8 mx-auto" method="POST">
                <div class="form-group row">
                    <label for="ce" class="col-4 col-form-label">Chair email</label>
                    <div class="col-8">
                        <input id="ce" name="ce" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="de" class="col-4 col-form-label">Department email</label>
                    <div class="col-8">
                        <input id="de" name="de" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="se" class="col-4 col-form-label">Secretary email</label>
                    <div class="col-8">
                        <input id="se" name="se" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-secondary float-right">Save</button>
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
<script src="../js/jquery.sortable.js"></script>
<script>
    $('.sortable1, .sortable2').sortable({
        connectWith: '.connected'
    });
</script>

<script src="../js/sequence.js"></script>
<?php

if (isset($_POST['modify'])) {

    alert("true");
}
include_once('components/footer.php');
?>