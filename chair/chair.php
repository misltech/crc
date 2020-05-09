<?php


/**
 * The front page of chair. This will show instructors on how to use their designed page.
 */
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
?>


 
     <!-- Start typing html stuff here -->

      <div class="container-fluid">
        <h1 class="mt-4">Hello, Admin</h1>
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        
      </div>

<?php
include_once('components/footer.php');
?>