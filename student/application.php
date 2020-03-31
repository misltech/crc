<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

//validate();


include_once('../newback/db_con3.php');

$user_email = $_SESSION['user_email'];
$sql = "SELECT fw_id, assigned_to, dept_code FROM application_info WHERE student_email = '$user_email'";
$query = mysqli_query($db_conn, $sql);

if ($query) {
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    }
}






?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">My Application</h1>
        <p class="lead">You can view the status of your application below</p>
        <hr class="my-4">



        <div class="card border-secondary mb-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body text-secondary">
                <h5 class="card-title text-center">BUS 221</h5>
                <h6 class="card-title">Spring 2020</h6>
                <p class="card-text">Progress bar goes here</p>

                <div id="progressBar"></div>
        <p>To manipulate the progress bar, click on a step above, or use one of the buttons below. Events logged to the console.</p>
        <button id="startLoop">Start Loop</button> <button id="stopLoop">Stop Loop</button> <button id="resetVisited">Reset Visited</button>
                
                <a href="#" class="btn btn-primary text-center">Edit Application</a>
            </div>
        </div>


        <div class="card border-danger mb-3">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body text-danger">
                <h5 class="card-title">CSB 221</h5>
                <p class="card-text">Set to red when application is rejected</p>
                <a href="#" class="btn btn-primary">See application</a>
            </div>
        </div>









    </div>
</div>


<?php
include_once('components/footer.php');
?>