<?php
if (!isset($_SESSION)) {
  session_start();
}


include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');

$title = null;
$semester = null;
$classnumber = null;
$grademode = null;
$credits = null;
$hours = null;

if (isset($_GET['fwid'])) {  //check for exising fwid
  $sql = "SELECT * FROM s20_application_util WHERE fw_id = " . $_GET['fwid'];
  $qsql  = mysqli_query($db_conn, $sql);
  $r = mysqli_num_rows($qsql);
  $fwid = $_GET['fwid'];
  if ($r == 1) {
    if (isset($_GET['exist']) and $_GET['exist'] == 1) { //if special param is set
      $sql = "SELECT * FROM s20_application_info WHERE fw_id = " . $_GET['fwid'];
      $qsql  = mysqli_query($db_conn, $sql);
      $r = mysqli_num_rows($qsql);
      $result = mysqli_fetch_assoc($qsql);
      console_log($title);
      $title = $result['project_name'];
      $semester = $result['semester'] . " " . $result['year'];
      $classnumber = $result['class_number'];
      $grademode = $result['grade_mode'];
      $credits = $result['credits'];
      $hours = $result['hours_per_wk'];

    }
  } else {
    header('Location: ./application.php');
  }
} else {
  header('Location: ./application.php');
}


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
              <input id="tl" value="<?php showifnotnull($title); ?>" name="tl" placeholder="Project name" type="text" required="required" class="form-control" autofocus>
            </div>
          </div>
          <div class="form-group row">
            <label for="sem" class="col-4 col-form-label">Semester</label>
            <div class="col-8">
              <select id="sem"  name="sem" required="required" class="custom-select">
                <option value="<?php showifnotnull($semester); ?>"><?php showifnotnull($semester); ?></option>
                <option value="fall">Fall 2020</option>
                <option value="Winter">Winter 2020</option>
                <option value="Spring">Spring 2021</option>
                <option value="Summer">Summer 2021</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="cn" class="col-4 col-form-label">Class Number</label>
            <div class="col-8">
              <select id="cn" value="<?php showifnotnull($classnumber); ?>" name="cn" class="custom-select">
              
              <?php 
              $sql = "SELECT id, CONCAT(dept_code, ' ', course_num) AS deptnum FROM s20_course_numbers";
              console_log($sql);
              $qsql  = mysqli_query($db_conn, $sql);
              $r = mysqli_num_rows($qsql);
              console_log($qsql);
              if($r > 0){
                while($result = mysqli_fetch_assoc($qsql)) {
                  // your code
                  console_log($result);
                  $id = $result['id'];
                  $deptnum = $result['deptnum'];
              ?>  

              <option value="<?php showifnotnull($id);?>"><?php showifnotnull($deptnum);?></option>
              
              <?php 
              }
              }else{
                //form error try again later. redirect
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="gm" class="col-4 col-form-label">Grade Mode</label>
            <div class="col-8">
              <select id="gm" value="<?php showifnotnull($grademode); ?>" name="gm" required="required" class="custom-select">
                <option value="lg">Letter Grades</option>
                <option value="pf">Pass/Fail</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="ac" class="col-4 col-form-label">Academic credits</label>
            <div class="col-8">
              <input id="ac" name="ac" step="1" min="1" type="number" value="<?php showifnotnull($credits); ?>" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="ac" class="col-4 col-form-label">Number of Hours/Week</label>
            <div class="col-8">
              <input id="ac" name="ac" type="number" min="0" step="1"value="<?php showifnotnull($credits); ?>" class="form-control" >
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="offset-4 col-8">
              <?php if (isset($_GET['exist']) and $_GET['exist'] == 1) { ?>

              <button name="submit" type="submit" class="btn btn-primary float-right">Save</button>

              <?php } else { ?>
                <button name="submit" type="submit" class="btn btn-primary float-right">Proceed</button>
                <?php } ?>
            </div>
          </div>
        
        </form>

      </div>
    </div>




  </div>

</div>








<?php

include_once('components/footer.php');


?>