<?php
if (!isset($_SESSION)) {
  session_start();
}

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');

global $pass;
global $email;
if (isset($_SESSION['user_email'])) {
  $em = $_SESSION['user_email'];
  $sql = "SELECT * FROM s20_UserPass WHERE email='$em'";
  $query = mysqli_query($db_conn, $sql);
  if ($query) {
    $result = mysqli_fetch_assoc($query);
    $email = $result['email'];
    $pass = $result['passcode'];
  } else {

  }
} else {
  redirect(null);
}

function filter()
{  //use this to filter the php inputs. If its null do something. Change the php inputs below to run through this filter

}
?>
<style>
  label {
    float: start;
  }
</style>
<div class="container ">
  <div class="jumbotron">
    <h1 class="display-4">My Account</h1>
    <p class="lead">You can modify your account details here.</p>
    <hr class="my-4">
    <nav class="mb-5 ">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active text-dark" id="student-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Change Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" id="password-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
        </li>
      </ul>
    </nav>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <div class="col-md-8 order-md-1 mx-auto">
            <form>
              <div class="form-group row">
                <label for="oem" class="col-4 col-form-label">Old Email address</label>
                <div class="col-8">
                  <input id="oem" name="oldemail" value="<?php echo $email;?>"type="email" class="form-control" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="em" class="col-4 col-form-label">New Email address</label>
                <div class="col-8">
                  <input id="em" name="newemail" type="email" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="nem" class="col-4 col-form-label">Confirm Email address</label>
                <div class="col-8">
                  <input id="nem" name="confirmemail" type="email" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="SubmitEmail" type="submit" class="btn btn-primary float-right mt-5">Save</button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="password-tab">
        <div class="row">
          <div class="col-md-8 order-md-1 mx-auto">
            <form>
              <div class="form-group row">
                <label for="oldpass" class="col-4 col-form-label">Old Password</label>
                <div class="col-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <input id="oldpass" name="oldpass" type="password" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="newpass" class="col-4 col-form-label">New Password</label>
                <div class="col-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <input id="newpass" name="newpass" type="password" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="confirmpass" class="col-4 col-form-label">Confirm Password</label>
                <div class="col-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <input id="confirmpass" name="confirmpass" type="password" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="SubmitPass" type="submit" class="btn btn-primary float-right mt-5">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php

include_once('./components/footer.php');

if (isset($_POST['SubmitPass']) ) {
  $oldpass = mysqli_real_escape_string($db_conn, $_POST['oldpass']);
  $newpass = mysqli_real_escape_string($db_conn, $_POST['newpass']);
  $confirmpass = mysqli_real_escape_string($db_conn, $_POST['confirmpass']);
  

  if(empty($newpass) or empty($confirmpass)){
    exit();
  }
  else if($newpass === $confirmpass){
      $update = "UPDATE s20_UserPass SET passcode='$confirmpass' WHERE email = '$email'";
      $uquery = mysqli_query($db_conn, $update);
      if($uquery){
        alert("Changed password");
      }
      else{
        alert("Update failed " . mysqli_errno($db_conn));
      }
  }
}
else if(isset($_POST['SubmitEmail'])){
  $newemail = mysqli_real_escape_string($db_conn, $_POST['newemail']);
  $confirmemail = mysqli_real_escape_string($db_conn, $_POST['confirmemail']);

  if(empty($newemail) or empty($confirmemail)){
    exit();
  }
  else if($newemail === $confirmemail){
    $update = "UPDATE s20_UserPass SET email='$confirmemail' WHERE email = '$email'";
    $uquery = mysqli_query($db_conn, $update);

    if($uquery){
      alert("Changed email");
    }
    else{
      alert("Update failed " . mysqli_errno($db_conn));
    }
  }
  
}

mysqli_close($db_conn);
?>