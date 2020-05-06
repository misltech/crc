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

                    <div id="sortableleft" class="list-group col">
                        <h6> Available Workflows</h6>

                        <?php
                        $defaultorder = array('Student', 'Instructor', 'Employer', 'Chair', 'Dean', 'Records and Registration');
                        $array_difference = array_values(array_diff($defaultorder, $order));
                        for ($k = 0; $k < count($array_difference); $k++) {
                            $differenceval = $array_difference[$k];

                        ?>
                            <div class="list-group-item"><?php echo $differenceval ?></div>

                        <?php } ?>
                        </ul>
                    </div>
                    <div id="sortableright" class="list-group col">
                        <h6> Current Workflow</h6>
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
                            <button id="submit-workflow" class="btn btn-secondary m-3 float-right" >Save Workflow</button>
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

if (isset($_POST['modify'])) {

    alert("true");
}
include_once('components/footer.php');
?>