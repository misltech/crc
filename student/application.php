<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

//validate();


include_once('../newback/db_con3.php');

$user_email = $_SESSION['user_email'];
$sql = "SELECT fw_id, assigned_to, dept_code FROM application_info WHERE student_email = '$user_email'";
$query = mysqli_query($db_conn, $sql);

if($query){
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){

    }
}






?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">My Application</h1>
        <p class="lead">You can view the status of your application below</p>
        <hr class="my-4">



        <div class="card text-white bg-success mb-3">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body">
                <h5 class="card-title">CSB 221</h5>
                <p class="card-text">Progress bar goes here</p>
                <a href="#" class="btn btn-primary">Edit Application</a>
            </div>
        </div>


        <div class="card text-white bg-danger">
            <div class="card-header">
                Internship
            </div>
            <div class="card-body">
                <h5 class="card-title">CSB 221</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>


       






    </div>
</div>


<?php
include_once('components/footer.php');
?>