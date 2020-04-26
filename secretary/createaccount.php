<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once '../backend/db_con3.php';

//print_r("Email was: " . sendEmail('tahirmitchell@aim.com', "", "This is the internship form"));

?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Create Accounts</h1>
    <p class="lead">You can generate a single new user, specific to their account type</p>
    <hr class="my-4">

    <nav class="mb-5">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student-body" role="tab" aria-controls="info" aria-selected="true">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="course-tab" data-toggle="tab" href="#dean-body" role="tab" aria-controls="course" aria-selected="false">Dean</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="employer-tab" data-toggle="tab" href="#chair-body" role="tab" aria-controls="employer" aria-selected="false">Chair</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="learning-tab" data-toggle="tab" href="#instructor-body" role="tab" aria-controls="learning" aria-selected="false">Instructor</a>
        </li>
      </ul>
    </nav>

    <div class="tab-content" id="createaccounttab">
      <div class="tab-pane  show active" id="student-body" role="tabpanel" aria-labelledby="student-tab">
        <form method="POST">
          <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email Address</label>
            <div class="col-8">
              <input id="email" name="email" placeholder="xxxx@email.com" type="email" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-4 col-form-label" for="banner">Banner ID</label>
            <div class="col-8">
              <input id="banner" name="banner" type="text" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label for="type" class="col-4 col-form-label">Department</label>
            <div class="col-8">
              <select id="type" name="utype" class="custom-select" value="" required="required">

                <?php
                $sql = "SELECT dept_code, dept_name FROM s20_academic_dept_info ORDER BY dept_code ASC";
                $qsql  = mysqli_query($db_conn, $sql);
                $r = mysqli_num_rows($qsql);

                if ($r > 0) {
                  while ($result = mysqli_fetch_assoc($qsql)) {
                    $id = $result['id'];
                    $deptname = $result['dept_name'];
                    $deptcode = $result['dept_code'];
                ?>

                    <option value="<?php showifnotnull($deptcode); ?>"><?php showifnotnull($deptname); ?></option>

                <?php
                  }
                } else {
                  //form error try again later. redirect
                }
                ?>

              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="type" class="col-4 col-form-label">User Type</label>
            <div class="col-8">
              <select id="type" name="utype" class="custom-select" required="required" disabled>
                <option value="student">Student</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit-student" type="submit float-right" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>

      </div>
      <div class="tab-pane  show " id="dean-body" role="tabpanel" aria-labelledby="dean-tab">
        <form>
          <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email Address</label>
            <div class="col-8">
              <input id="email" name="email" placeholder="xxxx@email.com" type="email" class="form-control" required="required">
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
              <select id="type" name="utype" class="custom-select" required="required" disabled>
                <option value="dean">Dean</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" id="student_create_button" type="submit float-right" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane  show " id="chair-body" role="tabpanel" aria-labelledby="chair-tab">
        <form>
          <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email Address</label>
            <div class="col-8">
              <input id="email" name="email" placeholder="xxxx@email.com" type="email" class="form-control" required="required">
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
              <select id="type" name="utype" class="custom-select" required="required" disabled>
                <option value="chair">Department Chair</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit float-right" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane  show " id="instructor-body" role="tabpanel" aria-labelledby="instructor-tab">
        <form>
          <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email Address</label>
            <div class="col-8">
              <input id="email" name="email" placeholder="xxxx@email.com" type="email" class="form-control" required="required">
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
              <select id="type" name="utype" class="custom-select" required="required" disabled>
                <option value="instructor">Instructor</option>
                <option value="employer">Employer</option>
                <option value="chair">Department Chair</option>
                <option value="dean">Dean</option>
                <option value="recreg">Records&Registration</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit float-right" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>


    </div>






  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<?php

include_once('../backend/db_con3.php');

if (isset($_POST['submit-student'])) { //handles student submit button
  $email = mysqli_real_escape_string($db_conn, $_POST['email']);
  $banner = mysqli_real_escape_string($db_conn, $_POST['banner']);
  $type = mysqli_real_escape_string($db_conn, $_POST['utype']);
  $banner = strtoupper($banner);

  //check if exists
  $pass = generatePassword(8);
  $insert = "INSERT INTO s20_UserPass (banner_id, email, profile_type, passcode) VALUES('$banner', '$email', 'student', '$pass')";
  $insertsql  = mysqli_query($db_conn, $insert);
  
  
  if (mysqli_errno($db_conn) == 1062) { //mean sduplicate entry
    if (strpos(mysqli_error($db_conn), 'PRIMARY')) { //checks if its in the error line
      //alert that banner id exits
      alert("banner id exist");
    } else if (strpos(mysqli_error($db_conn), 'email')) { //means duplicated email address. But different banner number
      alert("email exits");
      //alert that email exist.
      //bring up modal. ask to send a forgot email
    }
  } else if (mysqli_errno($db_conn) == 0) { //if user created and query success
    $fwid = bin2hex(random_bytes(32));  //duplication is unlikely with this one. However should make an method to catch duplication
    $newappsql = "INSERT INTO s20_application_info(fw_id, banner_id, dept_code, student_email, assigned_to, assigned_when) VALUES ('$fwid','$banner','$type', '$email', 'student', 'CURRENT_TIMESTAMP');"; ///get department code
    $newappsql .= "INSERT INTO s20_application_util(fw_id, progress, rejected) VALUES ('$fwid', '0', '0');"; 
    $insql = mysqli_multi_query($db_conn, $newappsql);
    if(mysqli_errno($db_conn) == 0){
      alert("success");
    }
    else{
      alert(mysqli_error($db_conn));
    }

    //echo "<meta http-equiv='refresh' content='0'>";
    //alert success
  }
}





//include_once('components/footer.php');
?>

</body>
</html>