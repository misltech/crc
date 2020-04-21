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
        <p class="lead">You can view the status of your application(s) below</p>
        <hr class="my-4">


        <div class="apps col-md-9 col-xs-12 col-sm-12 mx-auto">

        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="../js/raphael.js"></script>
<script src="../js/progressStep.js"></script>
<script src="../js/student.js"></script>
<script>
   $("#menu-toggle").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
   });
 </script>
<?php
//we dont include footer here. Special case
?>