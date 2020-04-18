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



<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Student Internship Information</h1>
    <p class="lead">You can view the status of your application below</p>
    <hr class="my-4">


    <div class="row">
      <div class="col-md-8 order-md-1 mx-auto">
        <form>
          <div class="form-group row">
            <label for="tl" class="col-4 col-form-label">Title of Project</label>
            <div class="col-8">
              <input id="tl" name="tl" placeholder="Project name" type="text" required="required" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="sem" class="col-4 col-form-label">Semester</label>
            <div class="col-8">
              <select id="sem" name="sem" required="required" class="custom-select">
                <option value="fall">Fall 2020</option>
                <option value="duck">Winter 2020</option>
                <option value="fish">Spring 2021</option>
                <option value="">Summer 2021</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="cn" class="col-4 col-form-label">Class Number</label>
            <div class="col-8">
              <select id="cn" name="cn" class="custom-select">
                <option value="rabbit">Rabbit</option>
                <option value="duck">Duck</option>
                <option value="fish">Fish</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="gm" class="col-4 col-form-label">Grade Mode</label>
            <div class="col-8">
              <select id="gm" name="gm" required="required" class="custom-select">
                <option value="lg">Letter Grades</option>
                <option value="pf">Pass/Fail</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="ac" class="col-4 col-form-label">Academic credits</label>
            <div class="col-8">
              <input id="ac" name="ac" type="text" class="form-control">
            </div>
          </div>
          <div class="form-group row mt-5">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary float-right">Proceed</button>
            </div>
          </div>
        </form>

      </div>
    </div>




  </div>

</div>








<?php

include_once('components/footer.php');
//semester form to input into database
?>