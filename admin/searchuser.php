<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Search for a Student</h1>
    <p class="lead">You can search for a student here. (not implemented on admin. Its equivalent is at view applications)</p>
    <hr class="my-4">
    <div class="d-flex justify-content-center mt-5">
      <form>
        <div class="form-group">
          <label for="uniquesearch">Search for a student</label>
          <input id="uniquesearch" name="uniquesearch" type="text" class="form-control" aria-describedby="uniquesearchHelpBlock" required="required">
          <span id="uniquesearchHelpBlock" class="form-text text-muted">N0365XXXX or xx@newpaltz.edu</span>
        </div>
        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-primary float-right">Search</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

//get all student info and applications currently
include_once('components/footer.php');
?>