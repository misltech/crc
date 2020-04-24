<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');


//print_r("Email was: " . sendEmail('tahirmitchell@aim.com', "", "This is the internship form"));

?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Create Account</h1>
    <p class="lead">You can generate a single new user, specific to their account type</p>
    <hr class="my-4">

    <nav class="mb-5 nav-pills nav-fill">
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
              <button name="submit" type="submit float-right" class="btn btn-primary">Create</button>
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

<?php
include_once('components/footer.php');
include_once('../backend/db_con3.php');

if (isset($_POST['submit-student'])) {

  $email = mysqli_real_escape_string($db_conn, $_POST['email']);
  $banner = mysqli_real_escape_string($db_conn, $_POST['banner']);
  $type = mysqli_real_escape_string($db_conn, $_POST['utype']);

  $banner = strtoupper($banner);


  //check if exists
  $insert = "INSERT INTO s20_UserPass (banner_id, email, profile_type, passcode) VALUES('$banner', '$email', 'student', " . generatePassword(8) . ")";
  $qsql  = mysqli_query($db_conn, $insert);

  if (mysqli_errno($db_conn) == 1062) { //mean sduplicate entry
    if (strpos(mysqli_error($db_conn), 'PRIMARY')) { //checks if its in the error line
      //alert that banner id exits
    } else if (strpos(mysqli_error($db_conn), 'email')) {
      //alert that email exist.
      //ask to send a forgot email
    }
  } else if (mysqli_errno($db_conn) == 0) {
    $newstudentinfosql = "INSERT INTO s20_studentinfo (banner_id, email) VALUES('$banner', '$email')";
    $insql = mysqli_query($db_conn, $newstudentinfosql);
    $fwid = bin2hex(random_bytes(32));
    
    $newappsql = "INSERT INTO s2_application_info($fw_id,)";

    while(strpos(mysqli_error($db_conn), 'PRIMARY')){ //if dupe found then keep trying till finds an empty fielcwork id. This is unlikely

    }
    $newvalidationsql = "";

    
    $newvalidation ="";
    $newapp = """;
    echo "<meta http-equiv='refresh' content='0'>";
    //alert success
  }


  //$result = mysqli_fetch_assoc($qsql);

}

?>