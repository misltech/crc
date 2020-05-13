<?php
ob_start();
if (!isset($_SESSION)) {
  session_start();
}


include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');


global $firstname;
global $lastname;
global $company;
global $email;
global $phone;
global $address;
global $suite;
global $city;
global $state;
global $zip;
global $fwid;
global $existing_app;
if (isset($_GET['fwid'])) { //check for exising fwid and that the parameter isnt new
  $fwid = $_GET['fwid'];
  $stuemail = $_SESSION['user_email'];
  $sql  = "SELECT * FROM s20_application_info WHERE fw_id = '$fwid' AND student_email = '$stuemail'"; //checks if they are allowed to view page
  $qsql = mysqli_query($db_conn, $sql);
  $r    = mysqli_num_rows($qsql);
  if ($r == 1) {  //no application found
    $sql       = "SELECT * FROM s20_company_info WHERE fw_id = '$fwid'";
    $qsql      = mysqli_query($db_conn, $sql);
    $r         = mysqli_num_rows($qsql);
    if ($r == 1) {
      $result    = mysqli_fetch_assoc($qsql);
      $firstname = $result['supervisor_first_name'];
      $lastname  = $result['supervisor_last_name'];
      $company   = $result['company_name'];
      $email     = $result['supervisor_email'];
      $phone     = $result['supervisor_phone'];
      $address   = $result['company_address'];
      $suite     = $result['company_address2'];
      $city      = $result['company_city'];
      $state     = $result['company_state'];
      $zip       = $result['company_zip'];
      $existing_app = true;
    } else {
      $existing_app = false;
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
    <h1 class="display-4">Employer Information</h1>
    <p class="lead">You can view the status of your application below</p>
    <hr class="my-4">

    <div class="row">
      <div class="col-md-8 order-md-1 mx-auto">
        <form class="needs-validation" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?php echo $firstname; ?>" required="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" name="lastname" id="lastName" placeholder="" value="<?php echo $lastname; ?>" required="">
            </div>

          </div>

          <div class="mb-3">
            <label for="email">Name of Organization: </label>
            <input type="text" class="form-control" name="organization" id="org" value="<?php echo $company; ?>" placeholder="">
          </div>
          <div class="row">
            <div class="col-md-8 mb-3">
              <label for="email">Email </label>
              <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="">
            </div>

            <div class="col-md-4 mb-3">
              <label for="phonenumber">Phone number</label>
              <input type="tel" maxlength=10 id="phonenumber" value="<?php echo $phone; ?>" name="phonenumber" type="text" class="form-control">

            </div>
          </div>
          <div class="mb-3">
            <label for="address">Site address</label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" required="">
          </div>

          <div class="mb-3">
            <label for="address2">Building/Suite#</label>
            <input type="text" class="form-control" name="aptnumber" id="address2" value="<?php echo $suite; ?>" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="zip">City</label>
              <input type="text" class="form-control" name="city" id="zip" value="<?php echo $city; ?>" placeholder="" required="">
            </div>

            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" name="state" id="state" value="<?php echo $state; ?>" required="">
                <option selected><?php echo $state; ?></option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
              </select>

            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" name="zipcode" class="form-control" id="zip" value="<?php echo $zip; ?>" placeholder="" required="">
            </div>

          </div>

          <hr class="mb-4">
          <?php if ($existing_app) { ?>
            <button name="save" type="submit" class="btn btn-primary float-right">Save</button>
          <?php } else { ?>
            <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>
          <?php } ?>


        </form>
      </div>
    </div>

  </div>

</div>
<?php
if (isset($_POST['proceed']) or isset($_POST['save'])) {
  $firstname = mysqli_real_escape_string($db_conn, $_POST['firstname']);
  $lastname  = mysqli_real_escape_string($db_conn, $_POST['lastname']);
  $organization = mysqli_real_escape_string($db_conn, $_POST['organization']);
  $email        = mysqli_real_escape_string($db_conn, $_POST['email']);
  $phonenumber  = mysqli_real_escape_string($db_conn, $_POST['phonenumber']);
  $address      = mysqli_real_escape_string($db_conn, $_POST['address']);
  $aptnumber    = mysqli_real_escape_string($db_conn, $_POST['aptnumber']);
  $city         = mysqli_real_escape_string($db_conn, $_POST['city']);
  $state        = mysqli_real_escape_string($db_conn, $_POST['state']);
  $zip          = mysqli_real_escape_string($db_conn, $_POST['zipcode']);

  if ($existing_app) {
    $update    = "UPDATE s20_company_info SET company_name = '$organization', supervisor_email = '$email', supervisor_phone = '$phonenumber', supervisor_first_name = '$firstname', supervisor_last_name = '$lastname', company_address = '$address', company_address2 = '$aptnumber', company_city = '$city', company_state = '$state', company_zip = '$zip'";
   
    $updatesql = mysqli_query($db_conn, $update);
    if (mysqli_errno($db_conn) == 0) {
      if(isset($_GET['edit']) and $_GET['edit'] == true){
        exit(header('Location: ./review.php?fwid=' . $fwid));
      }
      exit(header('Location: ./lo.php?fwid=' . $fwid));
    } else {
      alert("Update failed: " . mysqli_errno($db_conn));
    }
  } else {
    $insert    = "INSERT INTO s20_company_info(fw_id,company_name,supervisor_email,supervisor_phone, supervisor_first_name, supervisor_last_name, company_address, company_address2, company_city, company_state, company_zip) VALUES('$fwid','$organization','$email','$phonenumber','$firstname', '$lastname', '$address', '$aptnumber', '$city', '$state','$zip')";
    $insertsql = mysqli_query($db_conn, $insert);
    if ($insertsql) {
      exit(header('Location: ./lo.php?fwid=' . $fwid));
    } else {
      alert("Insert failed " . mysqli_errno($db_conn));
    }
  }
}


include_once('components/footer.php');
//semester form to input into database
?>