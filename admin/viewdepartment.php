<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">View Departments <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <button class="btn btn-secondary  ml-auto" type="button" onclick="window.location.href='./createdepartment.php'">Add Department</button>       
                </div>
            </span></h1>
        <p class="lead">You can view and modify assigned users for each department.</p>

        <hr class="my-4">

        <table id="departmenttbl" class="table table-responsive table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Chair Email</th>
                    <th>Dean Email</th>
                    <th>Secretary Email</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once('../backend/db_con3.php');

                $sql = "SELECT * FROM s20_academic_dept_info";
                $run = mysqli_query($db_conn, $sql);
                if (!$run) { //if failed to reach database
                    //errorlog this
                    exit();
                } else {
                    while ($row = mysqli_fetch_assoc($run)) {  //for each row
                        $code = $row['dept_code'];
                        $name = $row["dept_name"];
                        $chair = $row['chair_email'];
                        $dean = $row['dean_email'];
                        $secretary = $row['secretary_email'];
                        //$fwid = $row['fw_id'];
                        $modify = null;
                        console_log($row);
                ?>

                        <tr>
                            <td><?php echo $code; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $chair; ?></td>
                            <td><?php echo $dean; ?></td>
                            <td><?php echo $secretary; ?></td>
                            <td><a class="btn btn-primary btn-block" href="./editdepartment.php?department=<?php echo $code; ?>">Edit</a></button></td>

                        </tr>


                <?php  }
                } ?>
            </tbody>
        </table>
    </div>
</div>




<?php



include_once('components/footer.php');

?>