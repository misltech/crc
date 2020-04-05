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
  <div class="jumbotron">
    <h1 class="display-4">Create a workflow</h1>
    <p class="lead">You can generate a new workflow by departments here.</p>
    <hr class="my-4">
    <form>
    </form>
  </div>
</div>


<?php
include_once('components/footer.php');
?>