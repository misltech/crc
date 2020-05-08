<?php
ob_start();
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
    <h1 class="display-4">Create a Department</h1>
    <p class="lead">You can generate a new department here. This will use a default workflow order. Modify department in view.</p>
    <hr class="my-4">
    <?php if (isset($_GET['success']) and $_GET['success'] == 'false' and isset($_GET['exist']) and $_GET['exist'] == 'true') { ?>
      <div class="col-6 mx-auto alert alert-danger fade show">
        Department already exists
      </div>
    <?php } else if (isset($_GET['success']) and $_GET['success'] == 'true') { ?>
      <div class="col-6 mx-auto alert alert-success fade show">
        Department added!
      </div>
    <?php } else if (count($_GET) > 0) { ?>
      <div class="col-6 mx-auto alert alert-info fade show">
        <?php echo $_GET; ?>
      </div>

    <?php } ?>
    <div class="d-flex justify-content-center mt-5 mb-3">
      <form method="POST">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="dept_name">Department name</label>
            <input id="dept_name" name="deptname" type="text" class="form-control col-md-10">
          </div>
          <div class="col-md-4 mb-3">
            <label for="dept">Department code</label>
            <input id="dept" name="deptcode" maxlength='3' type="text" class="form-control col-md-6">
          </div>
        </div>
        <div class="form-group">
          <label for="deptemail">Department Email</label>
          <input id="deptemail" name="deptemail" type="email" class="form-control col-md-6">
        </div>
        <div class="form-group">
          <label for="deptsecemail">Department Secretary Email</label>
          <input id="deptsecemail" name="deptsecemail" type="text" class="form-control col-md-6">
        </div>
        <hr>
        <div class="mt-3 mb-3">
          <legend>Permissions</legend>
        </div>
        <div class="form-group">
          <label>Instructors can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm1_0" class="custom-control-label">modify course info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm1_1" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_2" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm1_2" class="custom-control-label">modify employer info</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Employers can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm2" id="perm2_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm2_0" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm2" id="perm2_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm2_1" class="custom-control-label">modify learning objectives</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Department Chairs can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm3_0" class="custom-control-label">modify course info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm3_1" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_2" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm3_2" class="custom-control-label">modify employer info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_3" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="perm3_3" class="custom-control-label">modify learning objectives</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mt-3 mb-3">
          <legend>Email Settings</legend>
        </div>
        <div class="form-group">
          <label>Students can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em1" id="em1_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em1_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em1" id="em1_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em1_1" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Instructors can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em2_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em2_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_2" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em2_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Department Chairs can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em3_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em3_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_2" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em3_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Deans can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_0" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em4_0" class="custom-control-label">recieve email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_1" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em4_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_2" type="checkbox" class="custom-control-input" value="" disabled>
              <label for="em4_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <button name="createdepartment" type="submit" class="btn btn-primary">Create Department</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

include_once '../backend/db_con3.php';

if (isset($_POST['createdepartment'])) {
  $deptname = mysqli_real_escape_string($db_conn, $_POST['deptname']);
  $deptcode = mysqli_real_escape_string($db_conn, $_POST['deptcode']);
  $deptemail = mysqli_real_escape_string($db_conn, $_POST['deptemail']);
  $deptsecemail = mysqli_real_escape_string($db_conn, $_POST['deptsecemail']);

  $insertDeptSQL = "INSERT INTO s20_academic_dept_info (dept_code, dept_name, dean_email, secretary_email) VALUES ('$deptcode', '$deptname', '$deptemail', '$deptsecemail')";
  $insertDeptQUERY = mysqli_query($db_conn, $insertDeptSQL);
  if (mysqli_errno($db_conn) === 1062) {
    exit(header('Location: ./createdepartment.php?success=false&exist=true'));
  } else if (mysqli_errno($db_conn) == 0) {
    alert(2);
    $defaultworkflow = array(0 => 'Student', 1 => 'Instructor', 2 => 'Employer', 3 => 'Chair', 4 => 'Dean', 5 => 'Records&Registration');
    $defaultworkflow = serialize($defaultworkflow);
    $insertworklowSQL = "INSERT INTO s20_workflow_order(dept_code, workflow) VALUES ('$deptcode','$defaultworkflow')";
    console_log($insertworklowSQL);
  
    $insertworklowQUERY = mysqli_query($db_conn, $insertworklowSQL);
    if (mysqli_errno($db_conn) == 0) {
      header('Location: ./createdepartment.php?success=true');
    }
    else{
      alert(mysqli_errno($db_conn));
    }
  } 
}

include_once 'components/footer.php';
?>