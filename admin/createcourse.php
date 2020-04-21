<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container">
<div class="d-flex justify-content-center mt-5">
    <p class="text-center">Coming soon!
        <br>
        This will allow you to add a class course to the form when a student signs up for the first time. You will be able to add and delete as you want.
    </p>
</div>
</div>
<?php
include_once('components/footer.php');
?>