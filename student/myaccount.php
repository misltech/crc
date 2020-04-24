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

function getStates()
{
  include_once('components/state_dropdown.php');
}
//validate();


include_once('../backend/db_con3.php');

if (isset($_SESSION['user_email'])) {
  $em = $_SESSION['user_email'];
  $sql = "SELECT * FROM s20_student_info WHERE student_email='$em'";

  $result = mysqli_query($db_conn, $sql);
  if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $firstname = $row['student_first_name'];
    $lastname = $row['student_last_name'];
    $middlename = $row['student_middle_initial'];
    $aptnum = $row['student_apt_num'];
    $phonenum = $row['student_phone'];
    $address = $row['student_address'];
    $city = $row['student_city'];
    $state = $row['student_state'];
    $zip = $row['student_zip'];
  } else {
    //Student data not found
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
          <a class="nav-link active" id="student-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Change Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="password-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
        </li>
      </ul>
    </nav>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <div class="col-md-8 order-md-1 mx-auto">
            <form>
              <div class="form-group row">
                <label for="text" class="col-4 col-form-label">Old email address</label>
                <div class="col-8">
                  <input id="text" name="text" type="text" class="form-control" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="text1" class="col-4 col-form-label">New Email</label>
                <div class="col-8">
                  <input id="text1" name="text1" type="text" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="text2" class="col-4 col-form-label">Confirm Email</label>
                <div class="col-8">
                  <input id="text2" name="text2" type="text" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="submit" type="submit" class="btn btn-primary float-right mt-5">Save</button>
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
                    <input id="oldpass" name="oldpass" type="text" required="required" class="form-control">
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
                    <input id="newpass" name="newpass" type="text" required="required" class="form-control">
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
                    <input id="confirmpass" name="confirmpass" type="text" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="submit" type="submit" class="btn btn-primary float-right mt-5">Save</button>
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


if (isset($_POST['modify'])) {
  $firstname = mysqli_real_escape_string($db_conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db_conn, $_POST['lastname']);
  $middlename = mysqli_real_escape_string($db_conn, $_POST['middlename']);
  $aptnum = mysqli_real_escape_string($db_conn, $_POST['aptnumber']);
  $phonenum = mysqli_real_escape_string($db_conn, $_POST['phonenumber']);
  $address = mysqli_real_escape_string($db_conn, $_POST['address']);
  $city = mysqli_real_escape_string($db_conn, $_POST['city']);
  $state = mysqli_real_escape_string($db_conn, $_POST['state']);
  $zip = mysqli_real_escape_string($db_conn, $_POST['zipcode']);

  $checksql = "SELECT student_email FROM s20_student_info  WHERE student_email = " . $_SESSION['user_email'];

  $w  = mysqli_query($db_conn, $checksql);
  $r = mysqli_num_rows($w);
  $user_email = $_SESSION['user_email'];
  $banner_id = $_SESSION['banner'];
  if ($r == 0) {  //if records not found

    $insert_update = "INSERT INTO s20_student_info (student_first_name, student_last_name, student_middle_initial,student_phone,student_address,student_apt_num,student_city,student_state,
    student_zip, student_email, banner_id) VALUES ('$firstname', '$lastname','$middlename',$phonenum','$address', '$aptnum', '$city', '$state','$zip', '$user_email', '$banner_id')";
    print_r($insert);
    $query = mysqli_query($db_conn, $insert);

    if (mysqli_affected_rows($db_conn) > 0) {
      //show update box
      alert("success");
    } else {
      ///failed
    }
  } else {


    $user_email = $_SESSION['user_email'];
    $sql = "UPDATE s20_student_info SET student_first_name = '$firstname', student_last_name = '$lastname', student_middle_initial = '$middlename', 
                  student_phone = '$phonenum', student_address = '$address', student_apt_num = '$aptnum', student_city = '$city', 
                  student_state = '$state', student_zip = '$zip' WHERE student_email = '$user_email'";
    console_log($sql);
    $query = mysqli_query($db_conn, $sql);

    if (mysqli_affected_rows($db_conn) > 0) {
      //echo "<meta http-equiv='refresh' content='0'>"; //this refresh the page. 
      echo '<script>$("#saveaccount").notify("Success!");</script>';
    } else {
      return alert("Update failed");
    }
  }
}


mysqli_close($db_conn);




?>