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
    <h1 class="display-4">Create a User</h1>
    <p class="lead">You can generate a single new user here. (Not implemented)</p>
    <hr class="my-4">
    <form>
      <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email Address</label>
        <div class="col-8">
          <input id="email" name="email" placeholder="@newpaltz" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-4 col-form-label" for="banner">Banner ID</label>
        <div class="col-8">
          <input id="banner" name="banner" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="type" class="col-4 col-form-label">User Type</label>
        <div class="col-8">
          <select id="type" name="type" class="custom-select" required="required">
            <option value="student">Student</option>
            <option value="secretary">Secretary</option>
            <option value="instructor">Instructor</option>
            <option value="employer">Employer</option>
            <option value="chair">Department Chair</option>
            <option value="dean">Dean</option>
            <option value="admin">Admin</option>
            <option value="recreg">Records&Registration</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-8">
          <button name="submit" type="submit" class="btn btn-primary float-right">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
include_once('components/footer.php');
?>