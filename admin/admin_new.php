<!-- MIT License Only  -->
<!-- Sourced from https://github.com/BlackrockDigital/startbootstrap-simple-sidebar -->

<?php

session_start();

include_once('../backend_new/config.php');
include_once('header.php');
include_once('sidebar.php');
include_once('topnav.php');
include_once('footer.php');
validate();
?>


 
     <!-- Start typing html stuff here -->

      <div class="container-fluid">
        <h1 class="mt-4">Something here? Porbably not lol</h1>
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        
      </div>

<?php

function validate(){
  include_once('../backend_new/config.php');

  if($_SESSION['user_type'] != 'admin'){
    redirect(null);
  }
  
}

?>