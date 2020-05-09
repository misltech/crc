<?php


/**
 * This is where the applications would show up for a chair to accept or reject. Never Implemented
 */


   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';

//validate();
?>


 
<?php
include_once'components/footer.php';
?>