<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Search for a Student</h1>
    <p class="lead">You can search for a student here.</p>
    <hr class="my-4">
    <div class="d-flex justify-content-center mt-5">
      <form>
        <div class="form-group row">
          <label for="banner" class="col-3 col-form-label">Search by N#</label>
          <div class="col-9">
            <input id="banner" name="banner" placeholder="N" type="text" class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-3 col-9">
            <button name="submit" type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div>
    <div class="d-flex justify-content-center mt-5 mb-2">
      <form>
        <div class="form-group row">
          <label for="email" class="col-3 col-form-label">Search by Email</label>
          <div class="col-9">
            <input id="email" name="email" placeholder="@newpaltz" type="text" class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-3 col-9">
            <button name="submit" type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  <?php
  include_once('components/footer.php');
  ?>