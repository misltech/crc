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
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?php echo $firstname;?>" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" name="lastname" id="lastName" placeholder="" value="<?php echo $lastname;?>" required="">
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
         
        </div>

        <div class="mb-3">
          <label for="email">Company Name </label>
          <input type="email" class="form-control" name="email" id="email" value="<?php echo $em;?>" placeholder="">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>
        <div class="row">
        <div class="col-md-8 mb-3">
          <label for="email">Email </label>
          <input type="email" class="form-control" name="email" id="email" value="<?php echo $em;?>" placeholder="">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="col-md-4 mb-3">
                <label for="phonenumber">Phone number</label> 
                <input type="text" id="phonenumber" value="<?php echo $phonenum;?>" name="phonenumber" type="text" class="form-control">
    
              </div>
        </div>
        <div class="mb-3">
          <label for="address">Site address</label>
          <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" required="">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Building/Suite#</label>
          <input type="text" class="form-control" name="aptnumber" id="address2" value="<?php echo $aptnum?>" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="zip">City</label>
            <input type="text" class="form-control" name="city" id="zip" value="<?php echo $city;?>" placeholder="" required="">
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="state" id="state" value="<?php echo $state;?>" required="">
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
            <input type="text" name="zipcode" class="form-control" id="zip" value="<?php echo $zip;?>" placeholder="" required="">
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>

        </div>

              
          
        <hr class="mb-4">

        <button class="btn btn-primary float-right" name="modify" type="submit">Proceed</button>
      </form>
    </div>
  </div>

  </div>

</div>





<?php

include_once('components/footer.php');
//semester form to input into database
?>

