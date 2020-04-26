<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Edit Courses</h1>
        <p class="lead"></p>
        <hr class="my-4">

    
    </div>
</div>

<script src="../js/sequence.js"></script>
<?php
include_once('components/footer.php');
?>