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
<div class="m-3">
<legend>Lookup Department</legend>
</div>
<div class="d-flex justify-content-center mt-5">
<form>
  <div class="form-group row">
    <label for="select" class="col-3 col-form-label"> Select a Department</label> 
    <div class="col-9">
      <select id="select" name="select" class="custom-select">
        <option value="rabbit">Rabbixxxxxxxxt</option>
        <option value="duck">Ducxxxxxxxxk</option>
        <option value="fish">Fixxxxxxxsh</option>
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-3 col-9">
      <button name="submit" type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>
</div>
<?php
include_once('components/footer.php');
?>