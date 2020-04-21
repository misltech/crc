<?php
//Employee data to be inserted here
//This should also pull data from database if user already submitted data.


if (!isset($_SESSION)) {
  session_start();
}


include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../newback/db_con3.php');

$firstname = null;
$lastname = null;
$company = null;
$email = null;
$phone = null;
$address = null;
$suite = null;
$city = null;
$state = null;
$zip = null;

if (isset($_GET['fwid'])) {  //check for exising fwid
  $sql = "SELECT * FROM s20_application_util WHERE fw_id = " . $_GET['fwid']; //checks if its a reject
  $qsql  = mysqli_query($db_conn, $sql);
  $r = mysqli_num_rows($qsql);
  $fwid = $_GET['fwid'];
  if ($r == 1) {
    if (isset($_GET['exist']) and $_GET['exist'] == 1) { //if special param is set
      $sql = "SELECT * FROM s20_company_info WHERE fw_id = " . $_GET['fwid'];
      $qsql  = mysqli_query($db_conn, $sql);
      $r = mysqli_num_rows($qsql);
      $result = mysqli_fetch_assoc($qsql);
      $firstname = $result['supervisor_first_name'];
      $lastname = $result['supervisor_last_name'];
      $company = $result['company_name'];
      $email = $result['supervisor_email'];
      $phone = $result['supervisor_phone'];
      $address = $result['company_address'];
      $suite = $result['company_address2'];
      $city = $result['company_city'];
      $state = $result['company_state'];
      $zip = $result['company_zip'];
    }
  } else {
    //header('Location: ./application.php');
  }
} else {
  //header('Location: ./application.php');
}

?>

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Employer Information</h1>
    <p class="lead">You can view the status of your application below</p>
    <hr class="my-4">

    <div class="row">
      <div class="col-md-8 order-md-1 mx-auto">
        <form class="needs-validation" method="post" action="myaccount" novalidate="" _lpchecked="1">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?php showifnotnull($firstname); ?>" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" name="lastname" id="lastName" placeholder="" value="<?php showifnotnull($lastname); ?>" required="">
            </div>

          </div>

          <div class="mb-3">
            <label for="email">Name of Organization: </label>
            <input type="email" class="form-control" name="email" id="email" value="<?php showifnotnull($company); ?>" placeholder="">
          </div>
          <div class="row">
            <div class="col-md-8 mb-3">
              <label for="email">Email </label>
              <input type="email" class="form-control" name="email" id="email" value="<?php showifnotnull($email); ?>" placeholder="">
            </div>

            <div class="col-md-4 mb-3">
              <label for="phonenumber">Phone number</label>
              <input type="tel" maxlength=10 id="phonenumber" value="<?php showifnotnull($phone); ?>" name="phonenumber" type="text" class="form-control">

            </div>
          </div>
          <div class="mb-3">
            <label for="address">Site address</label>
            <input type="text" class="form-control" name="address" id="address" value="<?php showifnotnull($address); ?>" required="">
          </div>

          <div class="mb-3">
            <label for="address2">Building/Suite#</label>
            <input type="text" class="form-control" name="aptnumber" id="address2" value="<?php showifnotnull($suite); ?>" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="zip">City</label>
              <input type="text" class="form-control" name="city" id="zip" value="<?php showifnotnull($city); ?>" placeholder="" required="">
            </div>

            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" name="state" id="state" value="<?php showifnotnull($state); ?>" required="">
                <option selected><?php showifnotnull($state); ?></option>
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
              <input type="text" name="zipcode" class="form-control" id="zip" value="<?php showifnotnull($zip); ?>" placeholder="" required="">
            </div>

          </div>



          <hr class="mb-4">

          <?php if (isset($_GET['exist']) and $_GET['exist'] == 1) { ?>

            <button name="submit" type="submit" class="btn btn-primary float-right">Save</button>

          <?php } else { ?>
            <button name="submit" type="submit" class="btn btn-primary float-right">Proceed</button>
          <?php } ?>


        </form>
      </div>
    </div>

  </div>

</div>





<?php
/**SQL TRIGGER THAT ONLY WORKS FOR ONE TRIGGER
 * INSERT INTO s20_faculty_info(banner_id,faculty_email)
*SELECT NEW.banner_id, NEW.email
*FROM (SELECT 1 a) dummy
*WHERE NEW.profile_type="faculty"
 */
include_once('components/footer.php');
//semester form to input into database
?>