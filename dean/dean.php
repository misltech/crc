<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once('../backend/util.php');
include_once('./components/header.php');
include_once('./components/sidebar.php');
include_once('./components/topnav.php');
?>


 
<?php
include_once'./components/footer.php';
?>