<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
    <h1 class="display-4">View Courses <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <button class="btn btn-secondary dropdown-toggle ml-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Course Settings
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./addcourse.php">Add a Course</a>
                        
                    </div>
                </div>
            </span></h1>
        <p class="lead">You can view and modify current courses here.</p>
        <hr class="my-4">
        <table id="coursetbl" class="table table-responsive table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Course Number</th>
                    <th>Modify </th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once('../newback/db_con3.php');

                $sql = "SELECT * FROM s20_course_numbers";
                $run = mysqli_query($db_conn, $sql);
                //alert($run);
                if (!$run) { //if failed to reach database
                    //errorlog this
                    exit();
                }

                while ($row = mysqli_fetch_assoc($run)) {  //for each email
                    $dept = $row['dept_code'];
                    $number = $row["course_num"];
                    $id = $row['id'];
                    $modify = null;
                    console_log($row);
                ?>

                    <tr>
                        <td><?php echo $dept; ?></td>
                        <td><?php echo $number; ?></td>
                        <td><a class="btn btn-primary btn-block" href="#">View</a></button></td>
                    </tr>


                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>




<?php
include_once('components/footer.php');

?>
