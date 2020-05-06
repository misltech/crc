<!-- MIT License Only  -->
<!-- Sourced from https://github.com/BlackrockDigital/startbootstrap-simple-sidebar -->
<?php

if (!isset($_SESSION)) {
  session_start();
}

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

//validate();
?>

<!-- Page Content -->

<div class="container ">
      <h1 class="mt-4">Hi, there!</h1>
      <p>Welcome to your internship fieldwork application website? LOL See instructions below </p>

    </div>
  </div>
  <!-- /#page-content-wrapper -->
</div>




<?php
include_once('components/footer.php');


?>