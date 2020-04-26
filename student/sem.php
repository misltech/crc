<?php
ob_start();

session_start();

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
$fwid = null;

if (isset($_GET['fwid'])) {  //check for exising fwid
  $fwid = $_GET['fwid'];
  $sql = "SELECT * FROM s20_application_util WHERE fw_id = '$fwid'";
  $qsql  = mysqli_query($db_conn, $sql);
  $r = mysqli_num_rows($qsql);
  if ($r == 1) {  //if application exists.
    if (isset($_GET['exist']) and $_GET['exist'] == 1) { //if special param is set
      $sql = "SELECT * FROM s20_application_info WHERE fw_id = '$fwid'";
      $qsql  = mysqli_query($db_conn, $sql);
      $r = mysqli_num_rows($qsql);
      $result = mysqli_fetch_assoc($qsql);
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
        <form method="post">
          <div class="form-group row">
            <label for="tl" class="col-4 col-form-label">Title of Project</label>
            <div class="col-8">
              <input id="tl" value="<?php showifnotnull($title); ?>" name="project_name" placeholder="Project name" type="text" required="required" class="form-control" autofocus>
            </div>
          </div>
          <div class="form-group row">
            <label for="sem" class="col-4 col-form-label">Semester</label>
            <div class="col-8">
              <select id="sem" name="sem" required="required" value="Summer 2020" class="custom-select" disabled>
                <option selected value="Summer 2020">Summer 2020</option>
                <option value="<?php showifnotnull($semester); ?>"><?php showifnotnull($semester); ?></option>
                <option value="Fall 2020">Fall 2020</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="cn" class="col-4 col-form-label">Class Number</label>
            <div class="col-8">
              <select id="cn" value="<?php showifnotnull($classnumber); ?>" name="cn" class="custom-select">

                <?php
                $sql = "SELECT s20_application_info.dept_code, s20_course_numbers.course_num FROM s20_application_info INNER JOIN s20_course_numbers ON s20_application_info.dept_code = s20_course_numbers.dept_code WHERE fw_id = '$fwid'";
                $query = mysqli_query($db_conn, $sql);
                if ($query) {
                  $r = mysqli_num_rows($query);
                  if ($r > 0) {
                    while ($result = mysqli_fetch_assoc($query)) {
                      $deptcode = $result['dept_code'];
                      $coursenum = $result['course_num'];
                ?>
                      <option value="<?php showifnotnull($deptcode . " " . $coursenum); ?>"><?php showifnotnull($deptcode . " " . $coursenum); ?></option>
                <?php
                    }
                  } else {
                    //form error try again later. redirect
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="gm" class="col-4 col-form-label">Grade Mode</label>
            <div class="col-8">
              <select id="gm" value="<?php showifnotnull($grademode); ?>" name="gm" required="required" class="custom-select">
                <option value="Letter Grades">Letter Grades</option>
                <option value="Pass/Fail">Pass/Fail</option>
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
              <input id="ac" name="hpw" type="number" min="0" step="1" value="<?php showifnotnull($credits); ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="offset-4 col-8">
              <?php if (isset($_GET['new']) and $_GET['new'] == true) { ?>
                <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>
              <?php } else { ?>
                <button name="save" type="submit" class="btn btn-primary float-right">Save</button>
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

if (isset($_POST['proceed']) or isset($_POST['save'])) {
  $title = mysqli_real_escape_string($db_conn, $_POST['project_name']);
  $semester = mysqli_real_escape_string($db_conn, $_POST['sem']);
  $classnumber = mysqli_real_escape_string($db_conn, $_POST['cn']);
  $grademode = mysqli_real_escape_string($db_conn, $_POST['gm']);
  $credits = mysqli_real_escape_string($db_conn, $_POST['ac']);
  $hours = mysqli_real_escape_string($db_conn, $_POST['hpw']);

  $sem = explode(" ", $semester);
  console_log($sem);
  $update = "UPDATE s20_application_info SET project_name = '$title', dept_code='$sem[0]', class_number='$sem[1]', grade_mode = '$grademode', academic_credits = '$credits', hours_per_wk = '$hours' WHERE fw_id = '$fwid'";
  console_log($update);
  exit();
  $updatesql = mysqli_query($db_conn, $update);

  if ($updatesql) {
      if($_POST['proceed']){
        exit(header('Location: ./emp.php?fwid=' . $fwid . "&new=true"));
      }
      else{
        exit(header('Location: ./review.php?fwid=' . $fwid . "&rej=1"));
      }
    
  } 
  else  if (mysqli_errno($db_conn) == 1062) { //if duplicates? !?!
    exit(header('Location: ./lo.php?fwid=' . $fwid . "&new=false"));
  }

}

?>