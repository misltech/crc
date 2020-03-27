<?php
if (!isset($_SESSION)) {
  session_start();
}


include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');


?>








<?php   

include_once('components/footer.php');

?>

//semester form to input into database