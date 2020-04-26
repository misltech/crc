<?php
ob_start();

session_start();

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');


$firstname = null;
$lastname = null;
$middlename = null;
$aptnum = null;
$phonenum = null;
$address = null;
$city = null;
$state = null;
$zip = null;
$email = null;
$credits = null;
if (isset($_GET['fwid'])) { //check for exising fwid and that the parameter isnt new
    $fwid = $_GET['fwid'];
    $sql  = "SELECT * FROM s20_application_util WHERE fw_id = '$fwid'"; //checks if its a reject
    $qsql = mysqli_query($db_conn, $sql);
    $r    = mysqli_num_rows($qsql);

    if ($r == 1) {
        if (isset($_GET['new']) and $_GET['new'] == false) { //if special param is set
            $sql  = "SELECT * FROM s20_student_info WHERE fw_id = '$fwid'";
            $qsql = mysqli_query($db_conn, $sql);
            $r  = mysqli_num_rows($qsql);
            $row = mysqli_fetch_assoc($result);
            $firstname = $row['student_first_name'];
            $lastname = $row['student_last_name'];
            $email = $row['student_email'];
            $middlename = $row['student_middle_initial'];
            $aptnum = $row['student_apt_num'];
            $phonenum = $row['student_phone'];
            $address = $row['student_address'];
            $city = $row['student_city'];
            $state = $row['student_state'];
            $zip = $row['student_zip'];
            $credits = $row['credits_registered'];
        } else if (isset($_GET['new']) and $_GET['new'] = true) {

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
        <h1 class="display-4">Student Information</h1>
        <p class="lead">student info stuff here</p>
        <hr class="my-4">
        <div class="col-md-8 order-md-1 mx-auto">
            <form method="post">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?php echo $firstname; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="lastName" placeholder="" value="<?php echo $lastname; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Middle Initial</label>
                        <input type="text" class="form-control" name="middlename" id="middlename" maxlength="1" placeholder="" value="<?php echo $middlename; ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" class="form-control col-md-6" name="email" id="email" value="<?php echo $email; ?>" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="address">Local Address: Street</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" required="">
                </div>

                <div class="mb-3">
                    <label for="address2">Apt. No. </label>
                    <input type="text" class="form-control" name="aptnumber" id="address2" value="<?php echo $aptnum ?>" placeholder="Apartment or suite">
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
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phonenumber">Phone number</label>
                    <input type="tel" id="phonenumber" value="<?php echo $phonenum; ?>" name="phonenumber" type="text" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="credits registered">Credits registered</label>
                    <input type="number" id="credits" maxlength="2" value="<?php echo $phonenum; ?>" name="credits" type="text" class="form-control col-md-4">
                </div>

                </div>
                

                <hr class="mb-4">


                <?php if (isset($_GET['new']) and $_GET['new'] == true) { ?>
                    <button name="proceed" type="submit" class="btn btn-primary float-right">Proceed</button>

                <?php } else { ?>
                    <button name="save" type="submit" class="btn btn-primary float-right">Save</button>

                <?php } ?>
            </form>
        </div>
    </div>

    <?php


    if (isset($_POST['proceed'])) {
        $firstname = mysqli_real_escape_string($db_conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db_conn, $_POST['lastname']);
        $middlename = mysqli_real_escape_string($db_conn, $_POST['middlename']);
        $aptnum = mysqli_real_escape_string($db_conn, $_POST['aptnumber']);
        $phonenum = mysqli_real_escape_string($db_conn, $_POST['phonenumber']);
        $address = mysqli_real_escape_string($db_conn, $_POST['address']);
        $city = mysqli_real_escape_string($db_conn, $_POST['city']);
        $state = mysqli_real_escape_string($db_conn, $_POST['state']);
        $zip = mysqli_real_escape_string($db_conn, $_POST['zipcode']);
        $credits = mysqli_real_escape_string($db_conn, $_POST['credits']);

    
        $insert = "INSERT INTO s20_student_info (fw_id, student_first_name, student_last_name, student_middle_initial,student_phone,student_address,student_apt_num,student_city,student_state,
       student_zip, student_email, credits_registered) VALUES ('$fwid','$firstname', '$lastname','$middlename',$phonenum','$address', '$aptnum', '$city', '$state','$zip', '$user_email', '$credits')";
        $insertsql = mysqli_query($db_conn, $insert);
        
        if ($insertsql) {
            exit(header('Location: ./sem.php?fwid=' . $fwid . "&new=true"));
          } else {
            alert("didnt work");
          }
            
    } else if (isset($_POST['save'])) {
        $firstname = mysqli_real_escape_string($db_conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db_conn, $_POST['lastname']);
        $middlename = mysqli_real_escape_string($db_conn, $_POST['middlename']);
        $aptnum = mysqli_real_escape_string($db_conn, $_POST['aptnumber']);
        $phonenum = mysqli_real_escape_string($db_conn, $_POST['phonenumber']);
        $address = mysqli_real_escape_string($db_conn, $_POST['address']);
        $city = mysqli_real_escape_string($db_conn, $_POST['city']);
        $zip = mysqli_real_escape_string($db_conn, $_POST['zipcode']);
        $state = mysqli_real_escape_string($db_conn, $_POST['state']);
        $credits = mysqli_real_escape_string($db_conn, $_POST['credits']);

        $update = "UPDATE s20_student_info SET student_first_name = '$firstname', student_last_name = '$lastname', student_middle_initial = '$middlename', 
        student_phone = '$phonenum', student_address = '$address', student_apt_num = '$aptnum', student_city = '$city', 
        student_state = '$state', student_zip = '$zip' credits_registered = '$credits' WHERE fw_id = '$fwid'";
        $updatesql = mysqli_query($db_conn, $update);

        if (mysqli_errno($db_conn) == 0) {
            exit(header('Location: ./review.php?fwid=' . $fwid . "&rej=1"));
        } else {
            alert("app failed to submit");
          }

    }


    mysqli_close($db_conn);



    include_once('./components/footer.php');


    ?>