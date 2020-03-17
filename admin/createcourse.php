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

<div class="d-flex justify-content-center mt-5">
    <p>Coming soon!</p>
</div>
<?php
include_once('components/footer.php');
?>