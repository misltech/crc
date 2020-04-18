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
        <h1 class="display-4">My Applications</h1>
        <p class="lead">You can view the status of your application below</p>
        <hr class="my-4">


        <div class="apps text-center">

        </div>
    </div>

</div>
<!-- 
        <div class="card border-secondary mb-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body text-secondary">
                <h4 class="card-title ">BUS 221</h4>
                <h5 class="card-title">SPRING 2020</h5>
                
                <div id="progressBar" class="progressB mx-auto"></div>
                <a href="#" class="offset-4 mt-2 btn btn-primary text-center">Edit Application</a>
            </div>
        </div>


        <div class="card border-danger mb-3">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body text-secondary">
                <h5 class="card-title">CSB 221</h5>
                <p class="card-text">Set to red when application is rejected</p>
                <div id="progressBar2" class="progressB mx-auto"></div>
                <a href="#" class="offset-4 btn btn-primary">See application</a>
            </div>
        </div> -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="../js/raphael.js"></script>
<script src="../js/progressStep.js"></script>
<script src="../js/student.js"></script>
<?php

?>