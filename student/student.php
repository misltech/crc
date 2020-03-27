<!-- MIT License Only  -->
<!-- Sourced from https://github.com/BlackrockDigital/startbootstrap-simple-sidebar -->
<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

//validate();
?>

    <!-- Page Content -->
   
      <div class="container-fluid">
        <h1 class="mt-4">Something here? Porbably not lol</h1>
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
 

  <?php
include_once('components/footer.php');


?>