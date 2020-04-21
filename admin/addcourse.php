<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Create a Course</h1>
    <p class="lead">You can generate a new course</p>
    <hr class="my-4">

  </div>
</div>



<script src="../js/sequence.js"></script>
<?php
include_once('components/footer.php');
?>