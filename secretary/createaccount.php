<?php
ob_start();
if (!isset($_SESSION)) {
  session_start();
}

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
include_once '../backend/db_con3.php';

// print_r("Email was: " . sendEmail('techwiz1997@gmail.com', "", "Please click on the link below and change your password immediately. This link only works once. You can reset your password on the website.\n$link"));

?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Create Accounts</h1>
    <p class="lead">You can generate a single new user, specific to their account type</p>
    <hr class="my-4">

    <?php if (isset($_GET['success']) and $_GET['success'] == 'true') { ?>
      <div class="alert alert-success fade show">
        Success! Email sent.
      </div>
    <?php } ?>

    <nav class="mb-5">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active text-dark" id="student-tab" data-toggle="tab" href="#student-body" role="tab" aria-controls="info" aria-selected="true">Create Student</a>
        </li>
      </ul>
    </nav>
    <div class="col-md-8 mx-auto">
      <div class="tab-content" id="createaccounttab">
        <div class="tab-pane  show active" id="student-body" role="tabpanel" aria-labelledby="student-tab">
          <form method="POST">
            <div class="form-group row">
              <label for="email" class="col-4 col-form-label">Email Address</label>
              <div class="col-8">
                <input id="email" name="email" placeholder="student@email.com" type="email" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label for="type" class="col-4 col-form-label">Department</label>
              <div class="col-8">
                <select id="type" name="utype" class="custom-select" size="1" value="" required="required">
                  <?php
                  $sql = "SELECT * FROM s20_course_numbers ORDER BY dept_code ASC";
                  $qsql  = mysqli_query($db_conn, $sql);
                  $r = mysqli_num_rows($qsql);

                  if ($r > 0) {
                    while ($result = mysqli_fetch_assoc($qsql)) {
                      $id = $result['id'];
                      $coursenum = $result['course_number'];
                      $deptcode = $result['dept_code'];
                  ?>

                      <option value="<?php echo $deptcode . " " . $coursenum; ?>"><?php echo $deptcode . " " . $coursenum; ?></option>

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
              <label for="type" class="col-4 col-form-label">Semester</label>
              <div class="col-8">
                <select id="type" name="sem" class="custom-select" required="required">
                 
                    <option value="Spring <?php echo date('Y'); ?>">Spring <?php echo date('Y'); ?></option>
                    <option value="Spring <?php echo date('Y'); ?>">Summer <?php echo date('Y'); ?></option>
                    <option value="Spring <?php echo date('Y'); ?>">Fall <?php echo date('Y'); ?></option>
                    <option value="Spring <?php echo date('Y'); ?>">Winter <?php echo date('Y'); ?></option>
                
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="gm" class="col-4 col-form-label">Grade Mode</label>
              <div class="col-8">
                <select id="gm" name="gm" required="required" class="custom-select">
                  <option value="Letter Grades">Letter Grades</option>
                  <option value="Pass/Fail">Pass/Fail</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-4 col-8">
                <button name="submit-student" type="submit" class="btn btn-primary float-right">Create</button>
              </div>
            </div>
          </form>

        </div>



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
  $type = mysqli_real_escape_string($db_conn, $_POST['utype']);
  $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
  $sem = explode(" ", $sem);
  $type = explode(" ", $type);
  $semester = $sem[0];
  $year = $sem[1];
  $dept = $type[0];
  $course = $type[1];
  //$pass = generatePassword(8);
  $pass = "1234";
  $insert = "INSERT INTO s20_UserPass (email, profile_type, passcode) VALUES('$email', 'student', '$pass')";
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
    $fwid = bin2hex(random_bytes(32));  //duplication is unlikely with this one.
    $newappsql = "INSERT INTO s20_application_info(fw_id, dept_code, course_number, student_email, semester, year) VALUES ('$fwid','$dept', '$course','$email', '$semester', '$year')"; ///get department code
    $newutilsql = "INSERT INTO s20_application_util(fw_id, progress, rejected, assigned_to, assigned_when) VALUES ('$fwid', '-1', '0', 'student', 'CURRENT_TIMESTAMP')";
    $insql = mysqli_query($db_conn, $newappsql);
    if (mysqli_errno($db_conn) == 0) {
      $insql = mysqli_query($db_conn, $newutilsql);
      if (mysqli_errno($db_conn) == 0) {
        $t = bin2hex(random_bytes(24));
        $link = getAPI() . "student/newstudent.php?token=$t";
        //$link = "https://" . $_SERVER['SERVER_NAME'] . "/~mitchelt6/crc/student/newstudent.php?token=$t";
        $newsql = "INSERT INTO s20_user_validation (email, token) VALUES ('$email', '$t')";
        $newtoken = mysqli_query($db_conn, $newsql);

        if ($newtoken) {
          $message = "Please click on the link below and change your password immediately. This link only works once. You can reset your password on the website.\n$link";
          sendEmail($email, "Welcome to your Fieldwork Application!", $message);
          header('Location: createaccount.php?success=true');
        } else {
          console_log(mysqli_error($db_conn));
        }
      }
    } else {
      //alert(mysqli_error($db_conn));
    }

    //echo "<meta http-equiv='refresh' content='0'>";
    //alert success
  }
}

include_once('components/footer.php');
?>