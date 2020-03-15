<?php

// Resume Session
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('backend/util.php');
include('skeleton.head.php');
include('components/drop_down.php');

//check user type

//checkUserType('student');

// check if session variable set for fw_id


if (!isset($_SESSION['fw_id'])) {
    setMessage(false, "You do not have access to this form.");
    header("Location: home.php");
}

$_SESSION['page_key'] = "student2";

echo "<h1>Enter Employer Information</h1>";

include('components/autofill_box.php');

// Build Fieldwork form below
?>

<form method="post" id="employerForm" action="backend/update-appinfo2.php" autocomplete="off">
    <label>
        <p>Company name</p>
        <?php
            $b_name = autofill_box('s20_employer_info', 'business_name', 'b_name');
        ?> 
    </label>
    <label>
        <p>Phone number</p>
        <?php
            $p_num = autofill_box('s20_employer_info', 'phone_number', 'p_num');
        ?>
    </label>
    <label>
        <p>First name</p>
        <?php
            $f_name = autofill_box('s20_employer_info', 'first_name', 'first_name');
        ?>
    </label>
    <label>
        <p>Last name</p>
        <?php
            $l_name = autofill_box('s20_employer_info', 'last_name', 'last_name');
        ?>
    </label>
    <label>
        <p>Company address</p>
        <?php
            $addr = autofill_box('s20_employer_info', 'street_address', 'address');
        ?>
    </label>
    <label>
        <p>City</p>
        <?php
            $city = autofill_box('s20_employer_info', 'city', 'city');
        ?>
    </label>
    <label>
        <p>State</p>
        <?php
            $state = "state";
            include('components/state_dropdown.php');
        ?>
    </label>
    <label>
        <p>Zip code</p>
        <?php
            $zip = autofill_box('s20_employer_info', 'zipcode', 'zip');
        ?>
    </label>
    <label>
        <p>E-mail address</p>
        <?php
            $email = autofill_box('s20_employer_info', 'employer_email', 'email');
        ?>
    </label>
    <input type="submit" value="Submit" />
</form>

<button onclick="window.location = 'student-application1.php';">Back</button>

<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$id = $_SESSION["fw_id"];

$sql = "SELECT employer_email FROM s20_application_info WHERE fw_id = '$id'";

include('backend/db_conn2.php');

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    if (isset($result['employer_email'])) {
        $e = $result['employer_email']; ?>
            <script>
                var email = document.getElementById("autofill-box-<?php echo("$email"); ?>");
                email.value = "<?php echo($e); ?>";
        <?php
        $sql = "SELECT * FROM s20_employer_info WHERE employer_email = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            ?>
                var b_name    = document.getElementById("autofill-box-<?php echo("$b_name"); ?>");
                b_name.value  = "<?php echo($result['business_name']); ?>";

                var phone     = document.getElementById("autofill-box-<?php echo("$p_num"); ?>");
                phone.value   = "<?php echo($result['phone_number']); ?>";
                
                var firstName = document.getElementById("autofill-box-<?php echo("$f_name"); ?>");
                firstName.value = "<?php echo($result['first_name']); ?>";
                
                var lastName  = document.getElementById("autofill-box-<?php echo("$l_name"); ?>");
                lastName.value = "<?php echo($result['last_name']); ?>";
                
                var address   = document.getElementById("autofill-box-<?php echo("$addr"); ?>");
                address.value = "<?php echo($result['street_address']); ?>"

                var city      = document.getElementById("autofill-box-<?php echo("$city"); ?>");
                city.value    = "<?php echo($result['city']); ?>";

                var state     = document.getElementById("state");
                state.value   = "<?php echo($result['state']); ?>";

                var zip       = document.getElementById("autofill-box-<?php echo($zip); ?>");
                zip.value     = "<?php echo($result['zipcode']); ?>";
        <?php } ?>
            </script>
        <?php
    }
}

include('skeleton.foot.php');

?>
