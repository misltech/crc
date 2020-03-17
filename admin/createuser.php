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
<div class="m-3">
<legend>Create a Student</legend>
</div>
<div class="d-flex justify-content-center mt-5">
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
    <label for="pass" class="col-4 col-form-label">Password</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-lock"></i>
          </div>
        </div> 
        <input id="pass" name="pass" type="text" required="required" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="confpass" class="col-4 col-form-label">Confirm Password</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-lock"></i>
          </div>
        </div> 
        <input id="confpass" name="confpass" type="text" required="required" class="form-control">
      </div>
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
      <button name="submit" type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</form>
</div>
</div>
<?php
include_once('components/footer.php');
?>