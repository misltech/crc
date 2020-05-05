<?php
ob_start();

session_start();

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');

global $title;
global $semester;
global $classnumber;
global $grademode;
global $credits;
global $hours;
global $fwid;
global $existing_app;
if (isset($_GET['fwid'])) {  //check for exising fwid
  $fwid = $_GET['fwid'];
  $banner = $_SESSION['banner'];
  $sql  = "SELECT * FROM s20_application_info WHERE fw_id = '$fwid' AND banner_id = '$banner'"; //checks if they are allowed to view page
  $qsql  = mysqli_query($db_conn, $sql);
  $r = mysqli_num_rows($qsql);
  if ($r == 1) {  //if application exists.
      $result = mysqli_fetch_assoc($qsql);
      $title = $result['project_name'];
      $semester = $result['semester'] . " " . $result['year'];
      $classnumber = $result['course_number'];
      $grademode = $result['grade_mode'];
      $credits = $result['academic_credits'];
      $hours = $result['hours_per_wk'];
      $existing_app = true; //unncessary
    }
} else {
  header('Location: ./application.php');
}

?>

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Student Internship Information</h1>
    <p class="lead">Enter internship info stufff</p>
    <hr class="my-4">

    <div class="row">
      <div class="col-md-8 order-md-1 mx-auto">
        <form method="post">
          <div class="form-group row">
            <label for="tl" class="col-4 col-form-label">Title of Project</label>
            <div class="col-8">
              <input id="tl" value="<?php echo $title; ?>" name="project_name" placeholder="Project name" type="text" required="required" class="form-control" autofocus>
            </div>
          </div>
          <div class="form-group row">
            <label for="sem" class="col-4 col-form-label">Semester</label>
            <div class="col-8">
              <select id="sem" name="sem" required="required" value="Summer 2020" class="custom-select" disabled>
                <option selected value="Summer 2020">Summer 2020</option>
                <option value="<?php echo $semester; ?>"><?php $semester; ?></option>
                <option value="Fall 2020">Fall 2020</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="cn" class="col-4 col-form-label">Class Number</label>
            <div class="col-8">
              <select id="cn" value="<?php echo $classnumber; ?>" name="cn" class="custom-select">

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
                      <option value="<?php echo $deptcode . " " . $coursenum; ?>"><?php echo $deptcode . " " . $coursenum; ?></option>
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
              <select id="gm" value="<?php echo $grademode; ?>" name="gm" required="required" class="custom-select">
                <option value="Letter Grades">Letter Grades</option>
                <option value="Pass/Fail">Pass/Fail</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="ac" class="col-4 col-form-label">Academic credits</label>
            <div class="col-8">
              <input id="ac" name="ac" step="1" min="1" type="number" value="<?php echo $credits; ?>" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="ac" class="col-4 col-form-label">Number of Hours/Week</label>
            <div class="col-8">
              <input id="ac" name="hpw" type="number" min="0" step="1" value="<?php echo $credits; ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row mt-5">
            <div class="offset-4 col-8">
              <?php if ($existing_app) { ?>
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
  $classnumber = mysqli_real_escape_string($db_conn, $_POST['cn']);
  $grademode = mysqli_real_escape_string($db_conn, $_POST['gm']);
  $credits = mysqli_real_escape_string($db_conn, $_POST['ac']);
  $hours = mysqli_real_escape_string($db_conn, $_POST['hpw']);

  $sem = explode(" ", $classnumber);
  $classnum = $sem[1];
  $classdept = $sem[0];

  $update = "UPDATE s20_application_info SET project_name = '$title', dept_code='$classdept', course_number='$classnum', grade_mode = '$grademode', academic_credits = '$credits', hours_per_wk = '$hours' WHERE fw_id = '$fwid'";
  console_log($update);
  $updatesql = mysqli_query($db_conn, $update);

  if ($updatesql) {
  
      if(isset($_GET['edit']) and $_GET['edit'] == true){
        exit(header('Location: ./review.php?fwid=' . $fwid .''));
      }
      else{
        exit(header('Location: ./emp.php?fwid=' . $fwid . "&new=true"));
      }
  } 
  else  if (mysqli_errno($db_conn) == 1062) { //if duplicates? !?!
    exit(header('Location: ./lo.php?fwid=' . $fwid . "&new=false"));
  }
  else{
    alert("Update failed: " . mysqli_errno($db_conn));
  }

}

?>